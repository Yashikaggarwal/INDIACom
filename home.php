<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="signup.css">

    <style>
        .home-content
        {
            text-justify: auto;
            margin:50px 100px 50px 100px;
            line-height: 25px;

        }
        #track {
        width: 80%;
        margin: 0 auto; /* Center align the table */
        border-collapse: collapse;
        margin-bottom: 80px;
        }

        #track th, #track td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }
        #track th {
            background-color: #07273b;
            color: white;
        }
        /* Alternate row colors */
        #track tr:nth-child(even) {
            background-color: #f2f2f2; /* Grey background color for even rows */
        }
        /* Track titles style */
        #track td:first-child {
            font-weight: bold;
        }
        /* Listing style */
        .listing {
            list-style-type: none;
            padding: 0;
        }
        #date-heading
        {
            color: #ce1815;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 10px;
            margin-left: 130px;
        }
        #HomeBanner {
        width: 100%;
        overflow: hidden; 
    }
    #HomeBanner img {
        width: 100%;
        height: auto; 
        display: block; 
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
                        <a href="home.php">Home</a>
                    </li>

                    <li class="dropdown" id="paperDropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="uploadPaper.php">
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

                    <li class="active">
                        <a href="paperView.php">View Paper</a>
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
                        <a class="dropdown-toggle" data-toggle="dropdown" href="signup.php">Registrations
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

        <div id="HomeBanner">
            <img src="homeBanner.jpg">
        </div>


        <p class="home-content">
            DELCON-2024 will be held at Bharati Vidyapeeth, New Delhi (INDIA). The conference will provide a platform for technical exchanges within the research community and will encompass regular paper presentation sessions, invited talks, key note addresses, panel discussions and poster exhibitions. In addition, the participants will be treated to a series of cultural activities, receptions and networking to establish new connections and foster everlasting friendship among fellow counterparts. The conference will also provide opportunity to the participants to visit some of the world’s famous tourist places in Delhi like Qutub Minar, Red Fort, Akshardham Temple, Lotus Temple, Jantar Mantar and Taj Mahal at Agra (around 200 KM from Delhi).<br><br>
            Prospective Authors are advised to visit <b>Submit Paper</b> Page for detailed submission instructions
        </p>
      
        <table id="track">
            <tr>

                <th width="15%"><span style="font-weight:bold; text-transform:uppercase;color:#fff;"><center>Track</center></span></th>
                <th width="30%"><span style="font-weight:bold; text-transform:uppercase;color:#fff;">Topics</span></th>

            </tr>
            <tr>
                <td style="font-weight:bold;"><center>Track 1</center></td>
                <td>
                    <ul class="listing">
                        Sustainable Computing
                    </ul>
                </td>


            </tr>
            <tr>
                <td style="font-weight:bold;"><center>Track 2</center></td>
                <td>
                    <ul class="listing">
                        High Performance Computing

                    </ul>
                </td>


            </tr>
            <tr>
                <td style="font-weight:bold;"><center>Track 3</center></td>
                <td>
                    <ul class="listing">
                        High Speed Networking and Information Security
                    </ul>
                </td>


            </tr>
            <tr>
                <td style="font-weight:bold;"><center>Track 4</center></td>
                <td>
                    <ul class="listing">
                        Software Engineering and Emerging Technologies
                    </ul>
                </td>


            </tr>
            <tr>
                <td style="font-weight:bold;"><center>Track 5</center></td>
                <td>
                    <ul class="listing">
                        Industrial and Commercial Applications of Technologies
                    </ul>
                </td>


            </tr>
            <tr>
                <td style="font-weight:bold;"><center>Track 6</center></td>
                <td>
                    <ul class="listing">
                        Devices, Circuits, Systems and VLSI Technologies
                    </ul>
                </td>


            </tr>
            <tr>
                <td style="font-weight:bold;"><center>Track 7</center></td>
                <td>
                    <ul class="listing">
                        Communications and Signal Processing
                    </ul>
                </td>


            </tr>
            <tr>
                <td style="font-weight:bold;"><center>Track 8</center></td>
                <td>
                    <ul class="listing">
                        Special Tracks: WIE, Industry, HTC, Education
                    </ul>
                </td>

            </tr>

        </table>
    <div id=date-heading>Important Dates/Timeline</div>
        <table id="track">

            <tbody>
                <tr>
                    <td>Deadline for Paper Submission</td>
                    <td> 22nd July, 2024</td>
                </tr>
                <tr>
                    <td>Decision</td>
                    <td>23rd September, 2024</td>
                </tr>
                <tr>
                    <td>Submission of Final Version of Paper</td>
                    <td>30th September, 2024</td>
                </tr>
                <tr>
                    <td>Registration Deadline (Early Bird)</td>
                    <td>30th September, 2024</td>
                </tr>
                <tr>
                    <td>Submission of Power Point Presentations</td>
                    <td>22nd October, 2024</td>
                </tr>
                <tr>
                    <td>Conference Date</td>
                    <td>21st to 23rd November, 2024</td>
                </tr>

            </tbody>


        </table>


    
    <footer>
        <div class="footer">
            Copyright ©2024 BVICAM , New Delhi | All rights reserved

        </div>   
    </footer>

</body>
</html>