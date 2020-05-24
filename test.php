
<!DOCTYPE html><html class=''>
<head>
<title>Iniesta</title>

<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
<script src="https://use.typekit.net/hoy3lrg.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="msg_dashboard.css">
</head>
<body>

	<!---Navigation bar-->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
        <a class="navbar-brand" style="color: teal; font-weight: bold;" href="#"><img src="iniesta-logo.jpg"
                alt="iniesta-logo" style="border-radius: 5px;"> INIESTA Freelancing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="" class="nav-link">Find Work</a>
                </li>
                <li class="nav-item dropdown trainings">
                    <a href="" class="nav-link">My Jobs</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="">Messages</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="" class="nav-link">My Profile &nbsp; <img class="feed-profile-logo"
                            src="images/feed-profile-logo.jpg" alt=""></a>
                </li>
            </ul>
        </div>   
    </nav>
<!---Navigation bar end-->
  <div class="body-container">
<!-----------------Client DP and Name------------------------->
<div id="frame">
	<div id="sidepanel">
		<div id="profile">
			<div class="wrap">
				<img id="profile-img" src="http://emilcarlsson.se/assets/mikeross.png" class="online" alt="" />
				<p>Client Name</p>
			</div>
		</div>
		<div id="search">
			<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
			<input type="text" placeholder="Search contacts..." />
		</div>


    <!---------- freelancer contacts ------------------------>
		<div id="contacts">
			<ul>
				<li class="contact active">
					<div class="wrap">
						<img src="http://emilcarlsson.se/assets/louislitt.png" alt="" /><!-- frelancer display picture-->
						<div class="meta">
							<p class="name">Freelancer Name</p><!-- frelancer Name-->
							<p class="preview">freelancers last msg</p><!-- frelancer Last message-->
						</div>
					</div>
				</li>
        <li class="contact">
					<div class="wrap">
						<img src="http://emilcarlsson.se/assets/louislitt.png" alt="" /><!-- frelancer display picture-->
						<div class="meta">
							<p class="name">Freelancer Name</p><!-- frelancer Name-->
							<p class="preview">freelancers last msg</p><!-- frelancer Last message-->
						</div>
					</div>
				</li>
			</ul>
		</div>
		<!--<div id="bottom-bar">
        bottom bar options if any

		</div>-->
	</div>
	<div class="content-box">
		<div class="contact-profile">
			<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" /> <!-- frelancer display picture (present chatting)-->
			<p>Present chatting Freelancer</p><!-- chatting freelancer name-->
		</div>
		<div class="messages"><!--client sent("sent") msgs and received("replies") replies-->
			<ul>
				<li class="sent">
					<p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
				</li>
				<li class="replies">
					<p>When you're backed against the wall, break the god damn thing down.</p>
				</li>
				<li class="replies">
					<p>Excuses don't win championships.</p>
				</li>
				<li class="sent">
					<p>Oh yeah, did Michael Jordan tell you that?</p>
				</li>
			</ul>
		</div>
		<div class="message-input">
			<div class="wrap">
			<input type="text" placeholder="Write your message..." />
            <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
			<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div></div>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script >$(".messages").animate({ scrollTop: $(document).height() }, "fast");


function newMessage() {
	message = $(".message-input input").val();
	if($.trim(message) == '') {
		return false;
	}
	$('<li class="sent"><p>' + message + '</p></li>').appendTo($('.messages ul'));
	$('.message-input input').val(null);
	$('.contact.active .preview').html('<span>You: </span>' + message);
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
};

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});
</script>

<!--------------footer-->
<br>
<div class="footer text-center" >
        <div class="footer-top row">
            <div class="col-lg-4">
                <h5><u><b>Help for you</b></u></h5>
                <h6><a type="button" data-toggle="modal" data-target="#contactModal">Contact Support</a></h6>
                <h6>FAQs</h6>
            </div>
            <div class="col-lg-4">
                <h5><u><b>Safety and Privacy</b></u></h5>
                <h6><a href="TERMS OF SERVICES.pdf">Terms of services</a></h6>
                <h6><a href="">Privacy Policy</a></h6>
                <h6>Safety Tips</h6>
            </div>
            <div class="col-lg-4">
                <h5><u><b>About</b></u></h5>
                <h6><a type="button" data-toggle="modal" data-target="#aboutModalScrollable">About us</a></h6>
                <h6><a type="button" data-toggle="modal" data-target="#careerModalLong">Careers</a></h6>
                <h6>Media</h6>
            </div>
        </div>
        <div class="footer-icons">
            <a href="https://www.facebook.com/iniestawebtech/"><i class="fab fa-facebook-f fa-2x"></i></a>
            <a href="https://www.linkedin.com/in/iniesta-webtech-solution-private-limited-111b82184/"><i
                    class="fab fa-linkedin fa-2x"></i></a>
            <a href="https://www.instagram.com/iniestawebtech/"><i class="fab fa-instagram fa-2x"></i></a>
        </div>
        <div class="text-center">
            <a href="">
                <h6>&copy; INIESTA 2020</h6>
            </a>
        </div>

    </div>
    <!-- footer end -->

    <!-- contact-modal -->
    <div style="text-align: left;" class="modal fade" id="contactModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contact Support</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Iniesta webtech solution pvt ltd <br>
                        Ring us at: <br>
                        9871428181 <br>
                        8182818101 <br>
                        Ping us at: <br>
                        email- Iniestawebtech@gmail.com <br>
                        Office Address <br>
                        Office number 3 third floor H-61 sector 63 Noida <br>
                        Uttar pradesh <br>
                        201306 <br></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- terms of services model -->
    <div style="text-align: left;" class="modal fade" id="careerModalLong" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Careers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <b>Service. Community. Quality.</b><br>
                        Our goal is to develop and nurture the world's largest digital marketplace, a place where people
                        can find and purchase all the services they need and create any company they dream of. As an
                        employee, the progress of our users and the celebration of your own personal development
                        inspires your work. Join in with us. <br>
                        <b>Our purpose comes first.</b><br>
                        It still feels like day one We believe the freelance economy is still at its earliest stages. We
                        take
                        the view that — as early advocates of it — our task is to do it as holistically as we can, to
                        introduce to all our goal of encouraging people to dream of living their work. <br>
                        We are an organisation powered by intent. Everything we do stems from our desire to inspire
                        people around the world to live their dream of working, develop their company from the ground
                        up and become financially and professionally independent.
                        <b>Locations</b><br>

                        ---------- ------------ --------------- <br>
                        Teams (Our Iniesta Employees) <br>
                        XXXXX <br>
                        YYYYY <br>
                        ZZZZZ <br>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- About us modal -->
    <div style="text-align: left;" class="modal fade" id="aboutModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">About us</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <b>Our Story</b><br>
                        The Iniesta story begins over a decade ago, when the tech lead of a Silicon Valley startup
                        realized his close friend in Athens would be perfect for an internet project. The team agreed he
                        was the most effective choice, but were concerned about working with someone halfway round the
                        globe. <br>

                        <b>A new way of working is born</b><br>
                        In response, the 2 friends created a brand new web-based platform that brought visibility and
                        trust to remote work. it had been so successful the 2 realized other businesses would also take
                        pleasure in reliable access to a bigger pool of quality talent, while workers would enjoy
                        freedom and adaptability to seek out jobs online. Together they decided to begin a corporation
                        that might deliver on the promise of this technology.
                        Fast-forward to today, that technology is that the foundation of Iniesta — the most important
                        global freelancing website. With countless jobs posted on Iniesta annually, freelancers are
                        earning money by providing companies with over 5,000 skills across over 70 categories of labor.
                        <br>
                        <b>A world of opportunities</b><br>
                        Through Iniesta businesses get more done, connecting with freelancers to figure on projects from
                        web and mobile app development to SEO, social media marketing, content writing, graphic design,
                        admin help and thousands of other projects. Iniesta makes it fast, simple, and cost-effective to
                        seek out, hire, work with, and pay the most effective professionals anywhere, any time.
                        <br>
                        <b>Iniesta’s vision</b> <br>
                        To be the number one flexible talent solution in the world. <br>
                        <b>Iniesta's mission</b><br>
                        To create economic opportunities so people have better lives. <br>
                        <b>Iniesta’s values</b><br>
                        Put our community first. <br>
                        Inspire a boundless future of work. <br>
                        Build amazing teams. <br>
                        Have a bias towards action. <br>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>