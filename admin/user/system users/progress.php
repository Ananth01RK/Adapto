<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/adapto/admin/includes/db.php");
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Setting Profile</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/adapto/admin/assets/css/style.css">
		<style>
			.progress-bar{
				background:linear-gradient(90deg,#59728a,#1e2f5a);
				border:5px solid #fff;
				border-radius:30px;
			}
			.progress{
				height:30px;
				border-radius:30px;
			}
			.progress-section{
				position:relative;
				margin-top:25%;
			}
		</style>
	</head>
	<body>
		<div class="container">
		<div id="particles-js"></div>
			<div class="row">
				<div class="progress-section text-center">
					<h3>Preparing your account....</h3>
					<div class="progress">
						<div class="progress-bar" id="progressbar" role="progressbar" style="width:0%"></div>
					</div>
				</div>
			</div>
		</div>
					
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
		<script type="text/javascript">
			setInterval(function(){var per = parseInt(document.getElementById("progressbar").style.width.replace("%",""));
            	if(per == 100){
					window.location='/adapto/admin/user/dashboard.php';
					return;
				}
				document.getElementById("progressbar").innerHTML = (per + 10) + "%";
                document.getElementById("progressbar").style.width = (per + 10) + "%";}, 1000);				
		</script>
		 
		<script >
			particlesJS("particles-js", {
			"particles": {
				"number": {
					"value": 60,
					"density": {
						"enable": true,
						"value_area": 900
					}
				},
				"color": {
					"value": "#ffffff"
				},
				"shape": {
					"type": "circle",
					"stroke": {
						"width": 0,
						"color": "#000000"
					},
					"polygon": {
						"nb_sides": 5
					},
					"image": {
						"src": "img/github.svg",
						"width": 100,
						"height": 100
					}
				},
				"opacity": {
					"value": 0.5,
					"random": false,
					"anim": {
						"enable": false,
						"speed": 1,
						"opacity_min": 0.1,
						"sync": false
					}
				},
				"size": {
					"value": 3,
					"random": true,
					"anim": {
						"enable": false,
						"speed": 40,
						"size_min": 0.1,
						"sync": false
					}
				},
				"line_linked": {
					"enable": true,
					"distance": 150,
					"color": "#ffffff",
					"opacity": 0.4,
					"width": 1
				},
				"move": {
					"enable": true,
					"speed": 6,
					"direction": "none",
					"random": false,
					"straight": false,
					"out_mode": "out",
					"bounce": false,
					"attract": {
						"enable": false,
						"rotateX": 600,
						"rotateY": 1200
					}
				}
			},
			"interactivity": {
				"detect_on": "canvas",
				"events": {
					"onhover": {
						"enable": true,
						"mode": "repulse"
					},
					"onclick": {
						"enable": true,
						"mode": "push"
					},
					"resize": true
				},
				"modes": {
					"grab": {
						"distance": 400,
						"line_linked": {
							"opacity": 1
						}
					},
					"bubble": {
						"distance": 400,
						"size": 40,
						"duration": 2,
						"opacity": 8,
						"speed": 3
					},
					"repulse": {
						"distance": 200,
						"duration": 0.4
					},
					"push": {
						"particles_nb": 4
					},
					"remove": {
						"particles_nb": 2
					}
				}
			},
			"retina_detect": true
		});
		</script>
	</body>
</html>