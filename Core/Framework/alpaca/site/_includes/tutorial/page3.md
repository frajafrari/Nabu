<html>
    <head>
        <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="//code.cloudcms.com/alpaca/{{site.alpaca_version}}/bootstrap/alpaca.min.js"></script>
        <link type="text/css" href="//code.cloudcms.com/alpaca/{{site.alpaca_version}}/bootstrap/alpaca.min.css" rel="stylesheet"/>
    </head>
    <body>
        <div id="form"></div>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#form").alpaca({
                    "schema": {
                        "title":"User Feedback",
                        "description":"What do you think about Alpaca?",
                        "type":"object",
                        "properties": {
                            "name": {
                                "type":"string",
                                "title":"Name"
                            },
                            "feedback": {
                                "type":"string",
                                "title":"Feedback"
                            },
                            "ranking": {
                                "type":"string",
                                "title":"Ranking",
                                "enum":['excellent','ok','so so']
                            }
                        }
                    },
                    "options": {
                        "helper": "Tell us what you think about Alpaca!",
                        "fields": {
                            "name": {
                                "size": 20,
                                "helper": "Please enter your name.",
                                "placeholder": "Enter your name"
                            },
                            "feedback" : {
                                "type": "textarea",
                                "rows": 5,
                                "cols": 40,
                                "helper": "Please enter your feedback."
                            },
                            "ranking": {
                                "type": "select",
                                "helper": "Select your ranking.",
                                "optionLabels": ["Awesome!", "It's Ok", "Hmm..."]
                            }
                        }
                    }
                });
            });
        </script>
    </body>
</html>
