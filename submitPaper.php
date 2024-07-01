<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Submit Paper</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script type="text/javascript">
        function toggleList(e){
            for (i=1;i<=6;i++)
            {
                if (e != toString(i))
                {
                    document.getElementById(i.toString()).style.display = 'none';
                }
            }
            element = document.getElementById(e).style;
            element.display == 'none' ? element.display = 'block' : element.display='none';
        }
    </script>

    <style>
        .generalTxt {
            font-size: 16px;
            color: #333;
        }

        .faq {
            color: blue;
            text-decoration: none;
            cursor: pointer;
        }

        .faq:hover {
            text-decoration: underline;
        }

        #1, #2, #3, #4, #5, #6 {
            margin-left: 20px;
        }
        .container
        {
            
    margin-top: 30px;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 800px; /* Increased width */
    margin-bottom: 80px;
    text-align: justify;
  
        }
    </style>

</head>
<body>
    <header class="header">
        <div id="first-navbar" style="background-color: #07273b;">
            <div id="first-container">
                <ul class="menu">
                    <li id="IEEE-delhi"><a style="color:#d7d005;" href="https://ewh.ieee.org/r10/delhi/" target="blank">IEEE Delhi section</a></li>
                    <li id="IEEE" ><a style="color:#d7d005;" href="https://www.ieee.org/about/index.html" target="blank">About IEEE</a></li>
                    <li id="BVICAM"><a style="color:#d7d005;" href="http://www.bvicam.ac.in/" target="blank">About BVICAM</a></li>
                </ul>
            </div>
        </div>
        <div id="second-navbar">
            <div id="second-container">
                <ul class="nav">
                    <li>
                        <a href="News.php" target="blank">News </a>
                    </li>

                    <li class="active">
                        <a href="https://bvicam.ac.in/Delcon2024/">Home</a>
                    </li>

                    <li class="dropdown" id="paperDropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Submit Paper
                            <i class="fa-solid fa-angle-down"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" id="paperDropdownMenu">
                            <li>
                                <a href="theme.php">Call for Papers</a>
                            </li>
                            <li>
                                <a href="submit-papers.php">Submit Paper</a>
                            </li>
                            <li>
                                <a href="qualities-policies.php">Quality Policies </a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Committees
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">									
                            <li>
                                <a href="committee.php">Committees</a>
                            </li>
                            <li>
                                <a href="patrons.php">Collaboration</a>
                            </li>
                        </ul>
                    </li>	

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Speakers<i class="fa-solid fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">									
                            <li>
                                <a href="call-speakers.php">Invited Speakers</a>
                            </li>
                            <li>
                                <a href="IEEE-Excom.php">IEEE ExCom </a>
                            </li>
                        </ul>
                    </li>	
                        
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registrations
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">									
                            <li>
                                <a href="registration.php">Registrations</a>
                            </li>
                            <li>
                                <a href="travel-stay.php">Travel and Stay </a>
                            </li>
                        </ul>
                    </li>
                       	
                    <li>
                        <a href="https://chitkara.edu.in/delcon2023" target="blank">Previous Edition </a>
                    </li>		

                    <li>
                        <a href="contact.php">Contact Us</a>
                    </li>						 
                </ul>
            </div>
        </div>
    </header>

    <div class="page-header-background">
        <div class="page-header-path">
            <a href="login.html" id="home-page">
                Home
            </a>
            <p>/</p>
            <a href="login.html" id="login-page">
                Submit Paper
            </a>
        </div>
        <div class="page-header-heading">
            <h1>SUBMIT PAPER</h1>
        </div>
    </div>
<div class="container">
    <p><b>Not Logged-In</b>&nbsp;
		<p class="generalTxt">
            This feature is accessible only to registered members of INDIACom website. You need to log-in with your Member ID before you proceed. If you do not have a Member ID at our website, please register with us. Registering with us is simple and fast, and its free too! You 
		    can access the <A href="signup.php">Membership Form here</A>, for registration and generation of Member ID.  </p> 
		<P class="generalTxt"><STRONG>If you are already a member, please <A href="login.php">proceed to the Log-In page</A>. </STRONG>   </P>     
		<P class="generalTxt"><STRONG>Note</STRONG>: If you are visiting this website for the first time, 
		  please read the guidelines given hereunder before you proceed. <br></p>


          
	<a class="faq" href="javascript:toggleList('1')">1. Guidelines to get membership</a><br/>
       
    <div id="1" style="display:none" text-align="justify">
    <p class="generalTxt">
        <b>Get Membership</b> - Getting membership to our site is the first step.&nbsp; You need to sign up using the <A class=guidelines href="addMember.asp">Get Membership</A> link. 
        This allots you a unique <STRONG>Member ID</STRONG> which helps the website to recognize you. And it is <b>Free!</b>   Please skip this step if you are already a member.<br> <br/>
        Your e-mail account, provided by you in the membership form is considered as <strong>registered e-mail ID </strong>by us, and the same would be used by us for further communication with you. To begin with, your <STRONG>Member ID</STRONG> and <STRONG>Password</STRONG> would be mailed to you. Please mail us, using your registered mail ID, at <A class=guidelines href="mailto:conference@bvicam.ac.in">conference@bvicam.ac.in</A> in case you don't receive this e-mail.<br>
        <br>
        <strong>Kindly Note that you do not need to re-register in case you had registered online as a member for any of the prior events like INDIACom, NSC, BIJIT etc. </strong>
        </p>
    </div>
	

	<a class="faq" href="javascript:toggleList('2')">2. Guidelines to submit paper</a><br/>
       
    <div id="2" style="display:none" text-align="justify">
        <p class="generalTxt">
            <b> Step 1 : Log in</b> - In order to submit a paper you need to log in to the web account using your 
            <STRONG>Member ID</STRONG> and <STRONG>Password</STRONG>. You can do this by <A class=guidelines href="login.asp">clicking here</A>.
        </p>
        <p class="generalTxt"><b>
            Step 2: Submit the paper</b> - You can now submit your paper using the
            <A class=guidelines href="submitPaper.asp">Submit Paper</A> link. Please note that all your co-authors must be members of this website and while submitting the paper you would need to provide their member IDs. When you submit a paper, a <STRONG>Unique Paper ID</STRONG> is allotted to it.
            Please use this ID for any queries regarding the paper, in future.
        </p>
    </div>


	<a class="faq" href="javascript:toggleList('3')">3. Guidelines to submit revised paper or related documents</a><br/>
	
    <div id="3" style="display:none" text-align="justify">
        <p class="generalTxt">
            <b>Step 1: Log in</b> - In order to submit revisions to your papers, you need to log in to the web account using your <STRONG>Member ID</STRONG> and <STRONG>Password</STRONG>. You can do this by <A class=guidelines href="login.asp">clicking here</A>.
        </p>
        <p class="generalTxt"><b>
            Step 2 : Submit the revisions</b> - The details of all the papers submitted by you would be visible in your <A class=guidelines href="members.asp">members area</A>. You can now submit revisions to your paper using the <em>Submit Revised Paper</em>link appearing next to the listed paper details. 
        </p>
    </div>

	<a class="faq" href="javascript:toggleList('4')">4. Guidelines to submit request for Convening a Special Session</a><br/>
	
        <div id="4" style="display:none" text-align="justify">

        <p class="generalTxt">
            <b>Step 1: Log in</b> - In order to submit revisions to submit request for Convening a Special Session, you need to log in to the web account using your <STRONG>Member ID</STRONG> and <STRONG>Password</STRONG>. You can do this by <A class=guidelines href="login.asp">clicking here</A>.
        </p>
        <p class="generalTxt"><b>
            Step 2 : Provide the details of your proposal</b> - You can now submit details of the proposed Special Session by using the <a href="splSessionRequest.asp">Submit Special Session Request</a> link. Please note that we need your Mobile Number and your Resume before processing your request. Thus, you are requested to ensure your profile is upto date by <a href="editProfile.asp">clicking here</a>. Once the request submitted by you is approved, the same would be <a href="specialSessions.asp">listed here</a> along with other <em>approved special sessions</em>.
        </p>

        </div>


	<a class="faq" href="javascript:toggleList('5')">5. Guidelines to join Technical Programme Committtee</a><br/>
	
        <div id="5" style="display:none" text-align="justify">

            <p class="generalTxt">
                <b>Step 1: Log in</b> - In order to submit a request for joining the Technical Programme Committee, you need to log in to the web account using your <STRONG>Member ID</STRONG> and <STRONG>Password</STRONG>. You can do this by <A class=guidelines href="login.asp">clicking here</A>.
            </p>
            <p class="generalTxt"><b>
                Step 2 : Provide Additional Required Information</b> - You can now submit your request for joining INDIACom TPC by providing some additional information by <a href="joinTPCTeam.asp">clicking here</a>. Please note that your basic information is picked from your profile provided by you at the time of registration. Thus, you are requested to ensure your profile is upto date by <a href="editProfile.asp">clicking here</a>. 
            </p>

        </div>


	<a class="faq" href="javascript:toggleList('6')">6. Guidelines to Submit Feedback </a><br/>
	
        <div id="6" style="display:none" text-align="justify">

            <p class="generalTxt">
                <b>Step 1: Log in</b> - Though you don't need to login to submit your feedback, but it would help us in communicating with you and improving our processes, in case you log in before provding us yor valuable feedback.
            </p>
            <p class="generalTxt">
                <b>Step 2: Provide your Valuable Feedback</b> - You can now rate your experince and provide suggestons for improvement by <a href="submitFeedback.asp">clicking here</a>. Please note that your basic information is picked from your profile provided by you at the time of registration. Thus, you are requested to ensure your profile is upto date by <a href="editProfile.asp">clicking here</a>. 
            </p>

        </div>
</div>

    <footer>
        <div class="footer">
            Copyright ©2024 BVICAM , New Delhi | All rights reserved

        </div>
        
    </footer>

</body>
</html>