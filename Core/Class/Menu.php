<?php


class Menu
{
	function Menu($id_page){
?>
		<nav id="menu">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#about">About us</a>
					<ul>
						<li><a href="#about/history">History</a></li>
						<li><a href="#about/team">The team</a>
							<ul>
								<li><a href="#about/team/management">Management</a></li>
								<li><a href="#about/team/sales">Sales</a></li>
								<li><a href="#about/team/development">Development</a></li>
							</ul>
						</li>
						<li><a href="#about/address">Our address</a></li>
					</ul>
				</li>
				<li><a href="#contact">Contact</a></li>
			</ul>
		</nav>
<?php
	}
}

?>
