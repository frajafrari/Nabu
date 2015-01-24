(function($) {

    var Alpaca = $.alpaca;

    Alpaca.ContainerField = Alpaca.Field.extend(
    /**
     * @lends Alpaca.ContainerField.prototype
     */
    {
        /**
         * Called during construction to signal that this field is a container field.
         */
        onConstruct: function()
        {
            this.isContainerField = true;
        },

        /**
         * @see Alpaca.Field#isContainer
         */
        isContainer: function()
        {
            return true;
        },

        getContainerEl: function()
        {
            return this.container;
        },

        /**
         * For container fields, we use the "container" template as the primary.
         *
         * @see Alpaca.Field#getTemplateDescriptorId
         * @returns {string}
         */
        getTemplateDescriptorId : function ()
        {
            return "container";
        },

        resolveContainerTemplateType: function()
        {
            // we assume the field type and then check the view to see if there is a template for this view
            // if not, we walk the parent chain until we find a template type

            var finished = false;
            var selectedType = null;

            var b = this;
            do
            {
                if (!b.getFieldType)
                {
                    finished = true;
                }
                else
                {
                    var d = this.view.getTemplateDescriptor("container-" + b.getFieldType(), this);
                    if (d)
                    {
                        selectedType = b.getFieldType();
                        finished = true;
                    }
                    else
                    {
                        b = b.constructor.ancestor.prototype;
                    }
                }
            }
            while (!finished);

            return selectedType;
        },

        /**
         * @see Alpaca.Field#setup
         */
        setup: function()
        {
            var self = this;

            this.base();

            var containerTemplateType = self.resolveContainerTemplateType();
            if (!containerTemplateType)
            {
                return Alpaca.throwErrorWithCallback("Unable to find template descriptor for container: " + self.getFieldType());
            }

            this.containerDescriptor = this.view.getTemplateDescriptor("container-" + containerTemplateType, self);

            var collapsible = true;

            if (!Alpaca.isEmpty(this.view.collapsible)) {
                collapsible = this.view.collapsible;
            }

            if (!Alpaca.isEmpty(this.options.collapsible)) {
                collapsible = this.options.collapsible;
            }

            this.options.collapsible = collapsible;

            var legendStyle = "button";

            if (!Alpaca.isEmpty(this.view.legendStyle)) {
                legendStyle = this.view.legendStyle;
            }

            if (!Alpaca.isEmpty(this.options.legendStyle)) {
                legendStyle = this.options.legendStyle;
            }

            this.options.legendStyle = legendStyle;

            //Lazy loading
            this.lazyLoading = false;
            if (!Alpaca.isEmpty(this.options.lazyLoading)) {
                this.lazyLoading = this.options.lazyLoading;
                if (this.lazyLoading) {
                    this.options.collapsed = true;
                }
                //delete this.options.lazyLoading;
            }
            // holders of references to children
            this.children = [];
            this.childrenById = {};
            this.childrenByPropertyId = {};
            // style icons
            this.expandedIcon = this.view.getStyle("expandedIcon");
            this.collapsedIcon = this.view.getStyle("collapsedIcon");
            this.commonIcon = this.view.getStyle("commonIcon");
            this.addIcon = this.view.getStyle("addIcon");
            this.removeIcon = this.view.getStyle("removeIcon");
            this.upIcon = this.view.getStyle("upIcon");
            this.downIcon = this.view.getStyle("downIcon");
        },

        /**
         * @see Alpaca.Field#destroy
         */
        destroy: function()
        {
            // if this container is DOM-wrapped with a form, then release the form
            if (this.form)
            {
                this.form.destroy(true); // pass in true so that we don't call back recursively
                delete this.form;
            }

            // destroy any child controls
            Alpaca.each(this.children, function() {
                this.destroy();
            });

            // call up to base method
            this.base();
        },

        /**
         * Add a "container" dom element inside of the field which houses our custom container.
         *
         * @see Alpaca.Field#renderField
         */
        renderFieldElements: function(callback) {

            var self = this;

            // find our insertion point
            // this is marked by the handlebars helper
            this.container = $(this.field).find("." + Alpaca.MARKER_CLASS_CONTAINER_FIELD);
            this.container.removeClass(Alpaca.MARKER_CLASS_CONTAINER_FIELD);

            // render
            self.prepareContainerModel(function(model) {
                self.beforeRenderContainer(model, function() {
                    self.renderContainer(model, function(containerField) {

                        if (containerField)
                        {
                            self.container.replaceWith(containerField);
                            self.container = containerField;

                            self.container.addClass(Alpaca.CLASS_CONTAINER);
                        }

                        // mark the form field with "alpaca-horizontal" or "alpaca-vertical"
                        if (self.view.horizontal)
                        {
                            self.container.addClass("alpaca-horizontal");
                        }
                        else
                        {
                            self.container.addClass("alpaca-vertical");
                        }

                        // CALLBACK: "container"
                        self.fireCallback("container");

                        self.afterRenderContainer(model, function() {

                            callback();
                        });

                    });
                });
            });
        },

        /**
         * Prepares the model for use in rendering the container.
         *
         * @param callback function(model)
         */
        prepareContainerModel: function(callback)
        {
            var self = this;

            var model = {
                "id": this.getId(),
                "name": this.name,
                "options": this.options
            };

            // load items into array and store on model for future use
            self.createItems(function(items) {

                if (!items)
                {
                    items = [];
                }

                model.items = items;

                callback(model);

            });
        },

        /**
         * Called before the container is rendered.
         *
         * @extension-point
         *
         * @param model
         * @param callback
         */
        beforeRenderContainer: function(model, callback)
        {
            var self = this;

            callback();
        },

        /**
         * Renders the container into the field container.
         *
         * @extension-point
         *
         * @param model
         * @param callback
         */
        renderContainer: function(model, callback)
        {
            var container = null;

            if (this.containerDescriptor)
            {
                container = Alpaca.tmpl(this.containerDescriptor, model);
            }

            callback(container);
        },

        /**
         * Called after the container is rendered.
         *
         * @extension-point
         *
         * @param model
         * @param callback
         */
        afterRenderContainer: function(model, callback)
        {
            var self = this;

            self.applyCreatedItems(model, function() {

                self.afterApplyCreatedItems(model, function() {

                    callback();

                });
            });
        },

        /**
         * @see Alpaca.Field#postRender
         */
        postRender: function(callback)
        {
            var self = this;

            this.base(function() {

                callback();

            });
        },

        /**
         * @see Alpaca.Field#initEvents
         */
        initEvents: function()
        {
            var self = this;

            this.base();

            /*
            if (self.options.collapsible)
            {
                // CALLBACK: "collapsible"
                self.fireCallback("collapsible");
            }
            */
        },

        /**
         * Creates any sub-items for this container.
         *
         * @extension_point
         *
         * @param callback
         */
        createItems: function(callback)
        {
            callback();
        },

        applyCreatedItems: function(model, callback)
        {
            var self = this;

            var layoutBindings = null;
            if (self.isTopLevel() && self.view.getLayout())
            {
                layoutBindings = self.view.getLayout().bindings;

                // if layout and bindings not provided, assume a default strategy
                if (!layoutBindings && self.view.getLayout().templateDescriptor && model.items.length > 0)
                {
                    layoutBindings = {};

                    for (var i = 0; i < model.items.length; i++)
                    {
                        var name = model.items[i].name;

                        layoutBindings[name] = "[data-alpaca-layout-binding='" + name + "']";
                    }
                }

            }

            if (model.items.length > 0)
            {
                $(self.container).addClass("alpaca-container-has-items");
                $(self.container).attr("data-alpaca-container-item-count", model.items.length);
            }
            else
            {
                $(self.container).removeClass("alpaca-container-has-items");
                $(self.container).removeAttr("data-alpaca-container-item-count");
            }

            for (var i = 0; i < model.items.length; i++)
            {
                var item = model.items[i];

                // find the insertion point
                var insertionPoint = $(self.container).find("[" + Alpaca.MARKER_DATA_CONTAINER_FIELD_ITEM_KEY + "='" + item.name + "']");
                if (!layoutBindings)
                {
                    var holder = $(insertionPoint).parent();

                    $(insertionPoint).replaceWith(item.field);

                    // reset domEl to allow for refresh
                    item.domEl = holder;
                }
                else
                {
                    // use a layout
                    var bindingId = layoutBindings[item.name];
                    if (bindingId)
                    {
                        var holder = $(bindingId, self.field);
                        if (holder.length == 0)
                        {
                            // legacy support, fallback to ID based
                            try {
                                holder = $('#' + bindingId, self.field);
                            } catch (e) { }
                        }
                        if (holder.length > 0)
                        {
                            $(item.field).appendTo(holder);

                            // reset domEl to allow for refresh
                            item.domEl = holder;
                        }
                    }

                    // remove insertion point
                    $(insertionPoint).remove();
                }

                $(item.field).addClass("alpaca-container-item");

                if (i === 0)
                {
                    $(item.field).addClass("alpaca-container-item-first");
                }

                if (i + 1 === model.items.length)
                {
                    $(item.field).addClass("alpaca-container-item-last");
                }

                $(item.field).attr("data-alpaca-container-item-index", i);
                $(item.field).attr("data-alpaca-container-item-name", item.name);

                // register the child
                self.registerChild(item, i);
            }

            if (self.options.collapsible)
            {
                // CALLBACK: "collapsible"
                self.fireCallback("collapsible");
            }

            self.triggerUpdate();
            callback();
        },

        afterApplyCreatedItems: function(model, callback)
        {
            callback();
        },

        /**
         * Helper method to add child field.
         *
         * @param {Alpaca.Control} child Child field to be added.
         * @param {Integer} index Index of the new child.
         */
        registerChild: function(child, index)
        {
            if (!Alpaca.isEmpty(index))
            {
                this.children.splice(index, 0, child);
            }
            else
            {
                this.children.push(child);
            }

            this.childrenById[child.getId()] = child;
            if (child.propertyId)
            {
                this.childrenByPropertyId[child.propertyId] = child;
            }

            child.parent = this;
        },

        /**
         * Helper method to remove child field.
         *
         * @param index
         */
        unregisterChild: function(index)
        {
            var child = this.children[index];
            if (!child)
            {
                return;
            }

            if (!Alpaca.isEmpty(index))
            {
                this.children.splice(index, 1);
            }

            delete this.childrenById[child.getId()];
            if (child.propertyId)
            {
                delete this.childrenByPropertyId[child.propertyId];
            }

            child.parent = null;
        },

        /**
         * This method gets invoked after items are dynamically added, removed or moved around in the child chain.
         * It adjusts classes on child DOM elements to make sure they're correct.
         */
        updateChildDOMElements: function()
        {
            var self = this;

            var layoutBindings = null;
            if (self.view.getLayout()) {
                layoutBindings = self.view.getLayout().bindings;
            }

            if (!layoutBindings)
            {
                if (self.children.length > 0)
                {
                    $(self.getContainerEl()).addClass("alpaca-container-has-items");
                    $(self.getContainerEl()).attr("data-alpaca-container-item-count", self.children.length);
                }
                else
                {
                    $(self.getContainerEl()).removeClass("alpaca-container-has-items");
                    $(self.getContainerEl()).removeAttr("data-alpaca-container-item-count");
                }

                for (var i = 0; i < self.children.length; i++)
                {
                    var child = self.children[i];

                    var field = child.getFieldEl();

                    // reset path and name
                    child.path = self.path + "[" + i + "]";
                    child.calculateName();

                    //$(field).removeClass("alpaca-container-item");
                    $(field).removeClass("alpaca-container-item-first");
                    $(field).removeClass("alpaca-container-item-last");
                    $(field).removeClass("alpaca-container-item-index");
                    $(field).removeClass("alpaca-container-item-key");

                    $(field).addClass("alpaca-container-item");

                    if (i === 0)
                    {
                        $(field).addClass("alpaca-container-item-first");
                    }
                    if (i + 1 === self.children.length)
                    {
                        $(field).addClass("alpaca-container-item-last");
                    }

                    $(field).attr("data-alpaca-container-item-index", i);
                    $(field).attr("data-alpaca-container-item-name", child.name);
                }
            }
        },

        /**
         * @see Alpaca.Field#setDefault
         */
            /*
        setDefault: function()
        {
            if (Alpaca.isEmpty(this.schema['default']))
            {
                Alpaca.each(this.children, function() {
                    this.setDefault();
                });
            }
            else
            {
                this.setValue(this.schema['default']);
            }
        },
        */

        /**
         * Clears the field and resets the field to its original value.
         *
         * @param stopUpdateTrigger If false, triggers the update event of this event.
         */
            /*
        clear: function(stopUpdateTrigger)
        {
            // clear all the kiddies
            Alpaca.each(this.children, function() {
                this.clear(false);
            });

            // trigger update all at once
            if (!stopUpdateTrigger) {
                this.triggerUpdate();
            }
        },
        */

        /**
         * Propagates signal down to all children.
         * @override
         */
        onDependentReveal: function()
        {
            for (var i = 0; i < this.children.length; i++)
            {
                this.children[i].onDependentReveal();
            }
        },

        /**
         * Propagates signal down to all children.
         * @override
         */
        onDependentConceal: function()
        {
            for (var i = 0; i < this.children.length; i++)
            {
                this.children[i].onDependentConceal();
            }
        },

        /**
         * Focus an element in the container.  Find the first invalid element or if no invalid elements, pick
         * the first child.
         */
        focus: function()
        {
            this.base();

            var index = -1;

            for (var i = 0; i < this.children.length; i++)
            {
                if (!this.children[i].isValid(true))
                {
                    index = i;
                    break;
                }
            }
            if (index === -1 && this.children.length > 0)
            {
                index = 0;
            }

            if (index > -1)
            {
                this.children[index].focus();
            }
        },

        /**
         * @see Alpaca.Field#disable
         */
        disable: function()
        {
            this.base();

            for (var i = 0; i < this.children.length; i++)
            {
                this.children[i].disable();
            }
        },

        /**
         * @see Alpaca.Field#enable
         */
        enable: function()
        {
            this.base();

            for (var i = 0; i < this.children.length; i++)
            {
                this.children[i].enable();
            }
        }

        /* builder_helpers */
        ,

        /**
         * @private
         * @see Alpaca.Field#getSchemaOfOptions
         */
        getSchemaOfOptions: function() {
            return Alpaca.merge(this.base(), {
                "properties": {
                    "lazyLoading": {
                        "title": "Lazy Loading",
                        "description": "Child fields will only be rendered when the fieldset is expanded if this option is set true.",
                        "type": "boolean",
                        "default": false
                    },
                    "collapsible": {
                        "title": "Collapsible",
                        "description": "Field set is collapsible if true.",
                        "type": "boolean",
                        "default": true
                    },
                    "collapsed": {
                        "title": "Collapsed",
                        "description": "Field set is initially collapsed if true.",
                        "type": "boolean",
                        "default": false
                    },
                    "legendStyle": {
                        "title": "Legend Style",
                        "description": "Field set legend style.",
                        "type": "string",
                        "enum":["button","link"],
                        "default": "button"
                    },
                    "animate": {
                        "title": "Animate movements and transitions",
                        "description": "Up and down transitions will be animated",
                        "type": "boolean",
                        "default": true
                    }
                }
            });
        },

        /**
         * @private
         * @see Alpaca.Field#getOptionsForOptions
         */
        getOptionsForOptions: function() {
            return Alpaca.merge(this.base(), {
                "fields": {
                    "lazyLoading": {
                        "rightLabel": "Lazy loading child fields ?",
                        "helper": "Lazy loading will be enabled if checked.",
                        "type": "checkbox"
                    },
                    "collapsible": {
                        "rightLabel": "Field set collapsible ?",
                        "helper": "Field set is collapsible if checked.",
                        "type": "checkbox"
                    },
                    "collapsed": {
                        "rightLabel": "Field set initially collapsed ?",
                        "description": "Field set is initially collapsed if checked.",
                        "type": "checkbox"
                    },
                    "legendStyle": {
                        "type":"select"
                    },
                    "animate": {
                        "rightLabel": "Animate movements and transitions",
                        "type": "checkbox"
                    }
                }
            });
        }
        /* end_builder_helpers */
    });

})(jQuery);
