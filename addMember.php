<?php
$showAlert=false;
$showError=false;
include 'dbconnect.php';
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        
        
        $salutation=$_POST["salutation"];
        $name=$_POST["name"];
        $address=$_POST["address"];
        $country=$_POST["country"];
        $state=$_POST["state"];
        $pincode=$_POST["pincode"];
        $mobile=$_POST["mobile"];
        $email=$_POST["email"];
        $interested_event=$_POST["interested_event"];
        $csi_membership_no=$_POST["csi_membership_no"];
        $ieee_membership_no=$_POST["ieee_membership_no"];
        $organisation=$_POST["organisation"];
        $category=$_POST["category"];
        $password=$_POST["password"];
        $confirm_password=$_POST["confirm_password"];
        $exists=false;
        if(($password==$confirm_password) && $exists==false)
        {
            $sql= "INSERT INTO `user` (`Salutation`, `Name`, `Address`, `Country`, `State`, `Pincode`, `Mobile`, `Email`, `Interested Event`, `CSI Membership No.`, `IEEE/ISTE/IETE/IITP/IMP Membership No.`,`Organisation`, `Category`, `Password`) VALUES ('$salutation', '$name', '$address', '$country', '$state', '$pincode', '$mobile', '$email', '$interested_event', '$csi_membership_no', '$ieee_membership_no', '$organisation','$category', '$password')";

            $result=mysqli_query($conn,$sql);
            if($result) {
                $showAlert=true;
            
                $last_inserted_id = $conn->insert_id;
                header("location: adminHomeMember.php");
                exit();
            }    
        }
        else
        {
            $showError="Password do not match";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Member</title>
<link rel="stylesheet" href="signup.css">

</head>
<body>

    <div class="page-header-background">
        <div class="page-header-path">
            <a href="login.html" id="home-page" style="color:red">
               Admin Home
            </a>
        </div>
        <div class="page-header-heading">
            <h1>
                Add Member</h1>
        </div>
    </div>
    <?php

    if($showAlert)
    {
       echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> Your account is now created and you can login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
        </div>';

    }
    if($showError)
    {
       echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>'.$showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

    }

    ?>
    
    <br>
<div class="signupform">

    <form action="/delcon/signup.php" method="post">
        <h2>Add Member</h2>
        <div class="form-group">
          <label for="salutation">Salutation:</label><br>
          <select id="salutation" name="salutation" required>
            <option value="Dr.">Dr.</option>
            <option value="Mr.">Mr.</option>
            <option value="Mrs">Mrs.</option>
            <option value="Ms.">Ms.</option>
            <option value="Prof.">Prof.</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="name">Name:</label><br>
          <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
          <label for="address">Address:</label><br>
          <input type="text" id="address" name="address" required>
        </div>

        <!-- <div class="form-group">
          <label for="country">Country:</label><br>
          <input type="text" id="country" name="country" required>
        </div> -->
        
        <div class="form-group">
        <label for="country">Country:</label><br>
        <select id="country" name="country" >
        </select>
        </div>

        <script>
    // Fetch list of countries from REST Countries API
    fetch('https://restcountries.com/v3.1/all')
        .then(response => response.json())
        .then(data => {
            // Sort the countries alphabetically by name
            data.sort((a, b) => {
                if (a.name.common < b.name.common) return -1;
                if (a.name.common > b.name.common) return 1;
                return 0;
            });
            const selectCountry = document.getElementById('country');
            // Iterate over each country and add it as an option in the select element
            data.forEach(country => {
                const option = document.createElement('option');
                option.value = country.name.common; // Set the country name as the option value
                option.textContent = country.name.common; // Set the country name as the option text
                selectCountry.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching country list:', error));
</script>

        
        <div class="form-group">
          <label for="state">State:</label><br>
          <input type="text" id="state" name="state" required>
        </div>
      
        <div class="form-group">
          <label for="pincode">Pincode:</label><br>
          <input type="text" id="pincode" name="pincode" required>
        </div>
        
        <div class="form-group">
          <label for="mobile">Mobile No.:</label><br>
          <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" required>
        </div>
        
        <div class="form-group">
          <label for="email">Email:</label><br>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="biodata">Biodata:</label><p style="color:grey ; font-size:15px">(Only doc / docx / pdf Formats)</p><br>
            <input type="file" id="biodata" name="biodata" accept=".doc, .docx, .pdf">
            
        </div>

        <div class="form-group">
        <label for="interested_event">Interested Event:</label><br>
        <select id="interested_event" name="interested_event" required>
            <option value="INDIACom">INDIACom</option>
            <option value="Webinar">Webinar</option>
            <option value="BJIT">BJIT</option>
            <option value="FDP">FDP</option>
            <option value="Industry 5.0">Industry 5.0</option>
             Add more options as needed
        </select>
    </div>

    <div class="form-group">
        <label for="csi_membership_no">CSI Membership No.:</label><br>
        <input type="text" id="csi_membership_no" name="csi_membership_no">
    </div>

    <div class="form-group">
        <label for="ieee_membership_no">IEEE/ISTE/IETE/IITP/IMP Membership No.:</label><br>
        <input type="text" id="ieee_membership_no" name="ieee_membership_no">
    </div> 

    <div class="form-group">
        <label for="organisation">Organisation: </label><p style="color:grey ; font-size:15px">( Select <b>Other</b> at the end of the list, if your organisation is not listed here. )</p><br>
        <select id="organisation" name="organisation">
            <option value>[Select]</option>
            <option value="2491"> Babu Banarasi Das University </option>
            <option value="2912"> Barkatullah University Institute of Technology, B</option>
            <option value="2107"> BRAANET Technologies  Pvt.  Ltd.</option>
            <option value="2519"> D Y Patil International University</option>
            <option value="1169"> Dalian Maritime University</option>
            <option value="672"> Institute of Management and Rural Development Adm</option>
            <option value="3354"> Karmveer Baburao Ganlarao Thakare College of Engi</option>
            <option value="4151"> Machhapuchchhre Bank Limited</option>
            <option value="4664"> National Aeronautics and Space Administration</option>
            <option value="1307"> Rayat Bahra University kharar Mohali</option>
            <option value="556"> Sasurie College of Enginering</option>
            <option value="1356">"Aurel Vlaicu", University of Arad</option>
            <option value="1563">"Ghe. Asachi" Technical University of Iasi</option>
            <option value="1416">"Gheorghe Asachi" Technical University of Iasi</option>
            <option value="3899">*</option>
            <option value="3119">-</option>
            <option value="3846">.</option>
            <option value="4038">.Vidya pracharini Sansthan</option>
            <option value="5139">00</option>
            <option value="4645">2174 BASIRUDDIN BIDYAPITH</option>
            <option value="4856">3R Recycler Pvt. Ltd.</option>
            <option value="3706">A C Patil College of Engineering</option>
            <option value="4353">A J Institute of Engineering and Technology</option>
            <option value="4621">A-one school</option>
            <option value="3764">A. P. S. W. Residential school</option>
            <option value="4290">A. S. Group of Institutions, Khanna</option>
            <option value="2705">A.A.N.M & V.V.R.S.R POLYTECHNIC, GUDLAVALLERU</option>
            <option value="1693">A.D.Patel Institute of Technology</option>
            <option value="3734">a.g.patil institute of technology solapur</option>
            <option value="4990">A.P.S. College of Engineering</option>
            <option value="3788">A.S.SURYA</option>
            <option value="3798">A.S.SURYA</option>
            <option value="1078">A.V.C COLLEGE OF ENGINEERING</option>
            <option value="1472">A.V.COLLEGE OF ARTS ,SCIENCE AND COMMERCE</option>
            <option value="3711">AAA COLLEGE OF ENGINEERING AND TECHNOLOGY</option>
            <option value="4084">AAA INTERNATIONAL SCHOOL</option>
            <option value="4677">AACSL</option>
            <option value="930">Aakruti Consultants</option>
            <option value="1499">Aalborg Universitet</option>
            <option value="1162">Aalborg University Denmark</option>
            <option value="3057">Aalim Muhammed Salegh College of Engineering</option>
            <option value="2687">AAR Mahaveer Engineering College</option>
            <option value="3816">Aarogyam Rehabilitation & Early Intervention Cente</option>
            <option value="2981">Aarti industry ltd</option>
            <option value="365">Aarupadai Veedu Institute of Technology</option>
            <option value="4675">AASTHA VIDYA MANDIR ENGLISH MEDIUM SCHOOL JAWANGA</option>
            <option value="4768">Abacus Institute of Engineering & Management</option>
            <option value="3849">Abacus Technologies</option>
            <option value="1801">Abb</option>
            <option value="3425">abc</option>
            <option value="3744">Abdul kalam institute of technological and science</option>
            <option value="3342">ABEDA INAMDAR SENIOR COLLEGE</option>
            <option value="1864">ABES Engineering College</option>
            <option value="2200">ABES Institute of technology , Ghaziabad</option>
            <option value="1978">Abhi Infocon Pvt. Ltd.</option>
            <option value="4429">Abhilashi University</option>
            <option value="4587">abhishek junior college</option>
            <option value="1576">Abn Amro Bank Ltd.</option>
            <option value="1392">ABV- Indian Institute of Information Technology an</option>
            <option value="3480">AC PATIL COLLEGE OF ENGINEERING</option>
            <option value="4529">Academic global school</option>
            <option value="23">Academy of Business & Engineering Scieneces,Ghazia</option>
            <option value="4310">Academy of excellence</option>
            <option value="3378">ACADEMY OF TECHNOLOGY</option>
            <option value="689">Acadmey of Technology and Management</option>
            <option value="727">acbcs</option>
            <option value="3935">Accel ltd</option>
            <option value="2203">Accendere Knowledge Management System Pvt Ltd</option>
            <option value="2257">Accenture</option>
            <option value="115">Accenture Services PVT , LTd</option>
            <option value="932">ACCMAN Institute of Managemen</option>
            <option value="4823">Accord School tirupati</option>
            <option value="515">Accurate Institute of Management  Technology</option>
            <option value="3471">ACE ENGINEERING COLLEGE</option>
            <option value="3668">Acharya institute of technology</option>
            <option value="2550">Acharya Institution</option>
            <option value="2159">ACHARYA N.G.RANGA AGRICULTURAL UNIVERSITY</option>
            <option value="578">Acharya Nagarjuna University</option>
            <option value="3349">Acharya Narendra Deva University of Agriculture an</option>
            <option value="1300">ACHARYA PRAFULLA CHNDRA COLLEGE</option>
            <option value="3054">ACHARYA SHREE NANESH SAMTA MAHAVIDYALA</option>
            <option value="3074">ACHARYA SHRIMANNARAYAN POLYTECHNIC PIPRI WARDHA</option>
            <option value="3942">Acharyya Prafulla Chandra Ray Polytechnic</option>
            <option value="1580">Acropoli Technical Campus</option>
            <option value="231">Acropolis institute of technology and research ind</option>
            <option value="130">Acropolis Institute of Technology and Research.</option>
            <option value="1561">Acropolis Technical Campus</option>
            <option value="1725">Acropolis Technical Campus</option>
            <option value="2214">Acropolis Technical Campus</option>
            <option value="2029">ACS College of Engineering</option>
            <option value="532">Adam's Engineering College</option>
            <option value="706">Adama University</option>
            <option value="4345">Adamas University</option>
            <option value="4950">Adani Institute of Digital Technology Management </option>
            <option value="4640">ADANI institute of infrastructure engineering</option>
            <option value="4841">Adarsh institute of technology and research centre</option>
            <option value="2454">Addis Ababa University</option>
            <option value="4288">Addis Abeba Science and technology university </option>
            <option value="1941">Adesh Institute of Technology, Gharuan</option>
            <option value="2698">ADGITM</option>
            <option value="2778">adglobal360 pvt ltd</option>
            <option value="4652">Adhichanalloor Panchayath High school </option>
            <option value="4973">Adhiyamaan College of Engineering, India</option>
            <option value="5113">Adi Shankara Institute of Engineering and Technolo</option>
            <option value="4582">Adikavi nannaya University</option>
            <option value="1554">Aditya College of Engineering</option>
            <option value="3087">ADITYA ENGINEERING COLLEGE (Autonomous)</option>
            <option value="2647">ADITYA INSTITUTE OF TECHNOLOGY AND MANAGMENT, TEKK</option>
            <option value="1889">ADITYA SILVER OAK INSTITUTE OF TECHNOLOGY</option>
            <option value="3623">ADJ Dharmambal polytechnic college</option>
            <option value="1427">ADRIN, DEPARTMENT OF SPACE</option>
            <option value="467">Advanced Institute of Technology & Management</option>
            <option value="3848">ADWAITA MISSION INSTITUTE OF TECHNOLOGY</option>
            <option value="1449">Aeronautial Development Agency ( Ministry of Defen</option>
            <option value="963">AES Institute of Computer Studies</option>
            <option value="319">AESICS</option>
            <option value="3481">AETINS GLOBAL SERVICES PRIVATE LIMTIED</option>
            <option value="4914">Africa University</option>
            <option value="3639">African University of Adrar Ahmed Draia Algeria</option>
            <option value="4743">African University of Science and Technology</option>
            <option value="1880">Agrawal school,Faridabad</option>
            <option value="1701">Agro Dairy & Foods Consultancy Services</option>
            <option value="3929">AGURCHAND MANMULL JAIN COLLEGE</option>
            <option value="3765">Ahmadu Bello University </option>
            <option value="3864">Ahsanullah University of Science and Technology</option>
            <option value="3049">AI's Akbar Peerbhoy College of Commerce and Econom</option>
            <option value="3094">AICTE </option>
            <option value="4023">AIIMS Rishikseh </option>
            <option value="1277">AIMT Lucknow</option>
            <option value="3967">AIRPORTS AUTHORITY OF INDIA</option>
            <option value="2956">AISAT Engineering College</option>
            <option value="1540">aisect university </option>
            <option value="4212">AISECT University</option>
            <option value="535">AISSMS College of Engg</option>
            <option value="540">AISSMS College of Engg</option>
            <option value="4427">AISSMS IOIT, Pune</option>
            <option value="797">Ajay Binay Institute Of Technology</option>
            <option value="1696">Ajay Kumar Garg Engineering College</option>
            <option value="164">Ajay Kumar Garg Engineering College</option>
            <option value="2703">Ajeenkya D Y Patil University- School of Hotel Man</option>
            <option value="2618">AJK  COLLEGE  OF  ARTS  AND  SCIENCE , COIMBATORE</option>
            <option value="3924">AJMVPS Institute of hotel Management and Catering </option>
            <option value="3715">Akal Group of Technical and Management Institutes,</option>
            <option value="1375">Akamai Technologies</option>
            <option value="2409">AKGEC Skills Foundation</option>
            <option value="790">AKI's Poona College of Arts, Science and Commerce</option>
            <option value="48">AKS Software Limited</option>
            <option value="1043">AKS University</option>
            <option value="1099">AKSHAYA INSTITUTE OF TECHNOLOGY</option>
            <option value="4292">Aksum University</option>
            <option value="915">AL AMEEN ENGINEERING COLLEGE,KULAPULLY</option>
            <option value="1823">AL BAHA UNIVERSITY </option>
            <option value="2124">Al Baha University</option>
            <option value="3358">AL FALAH UNIVERSITY</option>
            <option value="274">Al Fateh University</option>
            <option value="3746">Al Jamea tys Safiyah</option>
            <option value="4767">Al Kabir Polytechnic Jamshedpur</option>
            <option value="1736">Al-Barkaat College of Graduate Studies</option>
            <option value="1959">Al-Barkaat College of Graduate Studies,Aligarh</option>
            <option value="469">Al-Fateh university</option>
            <option value="471">Al-Fateh university</option>
            <option value="405">Al-Flah School of Engg.&Tech., Faridabad</option>
            <option value="4481">Al-Irfan secondary and senior secondary residentia</option>
            <option value="2908">ALAGAPPA CHETTIAR GOVERNMENT COLLEGE OF ENGINEERIN</option>
            <option value="185">Alagappa University</option>
            <option value="2837">Alagappa University Model Constituent College of A</option>
            <option value="2441">ALAMURI RATNAMALA ENGINEERING COLLEGE</option>
            <option value="2442">ALAMURI RATNAMALA ENGINEERING COLLEGE</option>
            <option value="1944">Alamuri ratnamala Institute of Engineering and Tec</option>
            <option value="3503">Ali yavar jung national institute of speech and he</option>
            <option value="2919">ALIAH UNIVERSITY</option>
            <option value="2572">Aligarh College of Engineering & Technology, Aliga</option>
            <option value="104">Aligarh Muslim University</option>
            <option value="102">Aligarh Muslim University</option>
            <option value="4800">Alight</option>
            <option value="4453">Alkabir polytechnic</option>
            <option value="3638">Alkesh Dinesh Mody Institute for Financial and Man</option>
            <option value="1658">ALL INDIA INSTITUTE OF MEDICAL SCIENCES</option>
            <option value="4925">All India Radio</option>
            <option value="1441">All India Shri shivaji Memorial Society's Institut</option>
            <option value="53">Allahabad Agricultural Institute - Deemed Universi</option>
            <option value="3630">Allahabad university</option>
            <option value="562">Allana Inst of Management Scie.</option>
            <option value="217">Alliance Business Academy</option>
            <option value="3827">ALLIANCE UNIVERSITY</option>
            <option value="2046">allodishajobcardwelfareassociation</option>
            <option value="676">Alluri Institute of Management Sciences</option>
            <option value="2559">Alpha Arts and Science College</option>
            <option value="1970">Alpha college of engineering & technology</option>
            <option value="4245">Alpha College of Engineering & Technology</option>
            <option value="4246">Alpha College of Engineering & Technology</option>
            <option value="4247">Alpha College of Engineering & Technology</option>
            <option value="4248">Alpha College of Engineering & Technology</option>
            <option value="4249">ALPHA COLLEGE OF ENGINEERING & TECHNOLOGY </option>
            <option value="4250">ALPHA COLLEGE OF ENGINEERING AND TECHNOLOGY </option>
            <option value="4251">ALPHA COLLEGE OF ENGINEERING AND TECHNOLOGY </option>
            <option value="2413">Alpha Consultants</option>
            <option value="3366">ALVA'S INSTITUTE FOR ENGINEERING AND TECHNOLOGY</option>
            <option value="4199">Alvas college of naturopathy and yogic sciences</option>
            <option value="2983">Amal Jyothi College of Engineering</option>
            <option value="4146">Amal NADH kp</option>
            <option value="1814">Amar Singh College</option>
            <option value="1815">Amar Singh College</option>
            <option value="2378">Ambaba Commer college, MIBM & DICA, Sabargam</option>
            <option value="3013">Ambai Arts college</option>
            <option value="2861">Ambai Arts college </option>
            <option value="635">Ambala College Of Engineering & Applied Research</option>
            <option value="5022">AMBALIKA INSTITUTE OF MANAGEMENT AND TECHNOLOGY, L</option>
            <option value="4881">Ambalika institute of professional studies </option>
            <option value="1046">Ambedkar Institute of Advanced Comm Tech and Resea</option>
            <option value="438">Ambedkar institute of Technology,Delhi</option>
            <option value="3909">Ambedkar University, Delhi</option>
            <option value="4963">Ambibuzz Technologies LLP</option>
            <option value="4041">ambo university</option>
            <option value="558">AMC ENGINEERING COLLEGE</option>
            <option value="3693">American International University-Bangladesh</option>
            <option value="1476">AMET UNIVERSITY</option>
            <option value="833">AMIT AMU UNDER UNDP</option>
            <option value="4268">Amity Global Business School</option>
            <option value="2447">Amity Institute of Information Technology, Amity U</option><option value="2895">Amity International Business School, Amity Univers</option><option value="2361">AMITY LUCKNOW CAMPUS</option><option value="360">Amity School of Engineering & Technology</option><option value="4976">Amity University</option><option value="5027">Amity University </option><option value="3453">Amity University Chhattisgarh</option><option value="1227">Amity University Gurgaon Haryana</option><option value="2509">Amity University Haryana</option><option value="2704">Amity University Jharkhand</option><option value="3495">Amity University Madhya Pradesh</option><option value="835">Amity University Rajasthan</option><option value="20">Amity University Uttar Pradesh</option><option value="5111">Amity University, Bengaluru</option><option value="1140">AMITY UNIVERSITY, CSE DEPARTMENT, ASET, AUUP NOIDA</option><option value="3063">Amity University, Kolkata</option><option value="1202">Amrapali Group of Institutes</option><option value="634">Amrapali group of institutes</option><option value="6">Amrapali Institute, Haldwani, Uttarakhand (INDIA)</option><option value="3554">AMRITA POLYTECHNIC COLLEGE</option><option value="189">Amrita School of Engineering</option><option value="392">Amrita University</option><option value="51">amrita VISHWA VIDYAPEETHAM</option><option value="107">Amrita Vishwa Vidyapeetham</option><option value="349">Amritsar College of Engg & Technology</option><option value="3431">Amritsar Group Of college, amritsar punjab </option><option value="4347">Amrutvahini College of Engineering Sangamner</option><option value="10">Amrutvahini College of Engineering, Sangamner</option><option value="4294">Amrutvahini Institute of Management & Business Adm</option><option value="1347">Anand Agricultural univeristy, anand</option><option value="2242">Anand College Jaipur</option><option value="3762">Anand commerce college</option><option value="1667">Anand Engineering college agra</option><option value="3805">Anand Institute of Higher Technology</option><option value="2222">Anand International College of Engineering, Jaipur</option><option value="179">Anand mercantile college</option><option value="4565">Anandaram Dhekial Phukan College</option><option value="1027">ANDHRA LOYOLA INSTITUTE OF ENGINEERING AND TECHNOL</option><option value="279">Andhra University</option><option value="4998">ANEKANT INSTITUTE OF MANAGEMENT STUDIES</option><option value="1822">ANIL NEERUKONDA INSTITUTE OF TECHNOLOGY & SCIENCES</option><option value="5109">Anjalai Ammal Mahalingam Engineering College</option><option value="4080">Anjuman College of Engineering And Technology, Nag</option><option value="4048">ANJUMAN INSTITUTE Of TECHNOLOGY And MANAGEMENT BHA</option><option value="2239">Anjuman Islam Kalsekar Technical Campus</option><option value="3103">Anjuman-I-Islam's Allana Institute of Management S</option><option value="350">Anna University</option><option value="54">Anna University</option><option value="2208">annai college</option><option value="1237">Annamalai University</option><option value="1402">Annasaheb Dange College of Engineering and Technol</option><option value="3246">Ansal University</option><option value="958">Ansal University</option><option value="2225">Ansal University, Gurgaon</option><option value="1768">ANSK Solutions</option><option value="2797">Anubhuti Foundation Mission (NGO)</option><option value="2791">Anubhuti Foundation Mission(NGO)</option><option value="3452">Anugrah narayan college, PATNA</option><option value="2852">Anurag college of Engineering </option><option value="3152">Anurag Engineering College</option><option value="4699">Anurag University</option><option value="2538">AP-IIIT RGUKT RK VALLEY</option><option value="310">Apeejay College of Engineering</option><option value="1894">Apeejay College of Fine Arts</option><option value="3256">Apeejay IMETC</option><option value="478">Apeejay Institute Of Management</option><option value="1242">Apeejay Institute of Management Technical Campus</option><option value="5062">Apeejay Institute of Mass Communication</option><option value="126">Apeejay School of Management</option><option value="1121">Apeejay Stya University</option><option value="646">APEX  Institute of Technology & managements</option><option value="1732">APEX College of Engineering</option><option value="3353">Apex Institute of Engineering and Technology Jaipu</option><option value="782">Apex Technology</option><option value="5098">Apex University, Jaipur </option><option value="275">APJ COLLEGE OF ENGG</option><option value="4456">Apollo Institute Of Technology kanpur</option><option value="3698">appin institute tech lab</option><option value="1012">Applied College of Management  & Engineering</option><option value="4201">Applied Environmental Research Foundation </option><option value="3298">AQA Quality Management Systems Pvt Ltd</option><option value="4296">AQHEAS</option><option value="4237">AR&TD</option><option value="2857">ARAVALI COLLEGE OF ENGINEERING AND MANAGEMENT, FAR</option><option value="4584">Arena Animation Academy</option><option value="1344">Aricent Technologies</option><option value="2616">ARIGNAR ANNA GOVERNMENT ARTS AND SCIENCE COLLEGE</option><option value="3337">Arka Jain University </option><option value="2031">Arkay College of Engineering & Technology</option><option value="4176">Arman Foundation</option><option value="3241">Army College of Dental Sciences</option><option value="3876">Army Institute of Hotel Management and Catering Te</option><option value="2174">ARMY INSTITUTE OF TECHNOLOGY</option><option value="2175">Army Institute of Technology, Pune</option><option value="3962">Army public school shillong</option><option value="3215">ARMY PUBLIC SCHOOL, KALUCHAK</option><option value="4905">Army War College</option><option value="3536">Arnav agriculture coaching institute</option><option value="2351">Arni University</option><option value="4224">AROEHAN</option><option value="15">Art, Culture & Language Department</option><option value="243">Arulmigu Kalasalingam College of Engineering</option><option value="1406">arulmurugan college of engineering</option><option value="3014">ARYA COLLEGE OF ENGINEERING AND IT</option><option value="1917">Arya Group of Colleges</option><option value="3341">Arya institute of engineering technology and manag</option><option value="3434">Arya Mahila P. G College </option><option value="2157">Aryabhatta college of Engineering & research cente</option><option value="3137">Aryabhatta College, University of Delhi</option><option value="4859">Aryabhatta Knowledge Univeristy </option><option value="182">Asansol Engg College</option><option value="4297">Asansol Institute of Engineering and Management- p</option><option value="4442">Asansol North point school </option><option value="3278">ASBM UNIVERSITY</option><option value="235">asdert</option><option value="1473">Asea Brown & Boveri INDIA LTD</option><option value="2708">Ashoka Institute of technology and management </option><option value="2169">Ashoka University</option><option value="1011">Ashokrao Mane Group Of Institutes</option><option value="1883">Ashokrao Mane Group of Institutions</option><option value="1368">Asia pacific Institute of information and Technolo</option><option value="919">Asia-Pacific Institute of Management</option><option value="4346">Asian Business School </option><option value="3543">Asian school of business</option><option value="5071">Asian School of Media Studies</option><option value="1612">ASSAM DON BOSCO UNIVERSITY</option><option value="3086">Assam down town University</option><option value="1460">Assam Engg. Institute</option><option value="683">Assam University, Silchar</option><option value="774">Assistant Professor,  Department of Library and In</option><option value="2745">Assistant Professor, Dr. APJ Abdul Kalam Women's I</option><option value="3356">Astu/Bpc</option><option value="2229">Aswini Bajaj Classes</option><option value="2901">Atal Bihar Vajpayee government Institute of engine</option><option value="3459">Atal Bihari Bajpayee Vishwavidyalaya </option><option value="1849">Atharva College Of Engineering</option><option value="66">ATI EPI GREENPARK</option><option value="1847">Atma Ram Santan Dharma College</option><option value="1777">ATME College Of Engineering</option><option value="421">Atmiya Institute of Technology & Science,</option><option value="4374">Atmiya University</option><option value="4138">Atomic Energy Regulatory Board</option><option value="4629">Atos Inc</option><option value="3688">Atria institue of technology </option><option value="4951">Audensiel </option><option value="1485">Audisankara college of engineering and Technololgy</option><option value="2696">AULC</option><option value="2329">Aurionpro Solutions Ltd</option><option value="2290">AURO University</option><option value="3226">Aurora's Degree & PG</option><option value="2955">AURORA'S TECHNOLOGICAL AND MANAGEMENT ACADEMY</option><option value="4419">Australian National University</option><option value="4420">Australian National University</option><option value="2463">Auxilium College (Autonomous)</option><option value="1393">AV Technologies </option><option value="3449">Avanthi</option><option value="108">Avinashilingam University for Women</option><option value="4559">AVNIET HYDERABAD</option><option value="2581">AVS Engineering College </option><option value="4186">Awadhesh Pratap Singh University</option><option value="2283">Axis Institute of Technology & Management </option><option value="3901">Ayya Nadar Janaki Ammal College</option><option value="1139">azad institute of engineering and technology luckn</option><option value="523">Azad Institute of Engineering and Technology, Luck</option><option value="4386">B H Gardi College of Engineering and Technology</option><option value="1742">B K Birla Institute of Engineering & Technology</option><option value="4597">B K College Chikodi</option><option value="38">B N M Instt of tech</option><option value="2574">B P MANDAL COLLEGE OF ENGINEERING, MADHEPURA</option><option value="3674">B P Poddar Institute of Management and Technology</option><option value="2924">B V C Institure od technology & Science</option><option value="484">B. M. College of Tech. Mgmt.</option><option value="1448">B. V. Raju Institute of Technology</option><option value="472">B.B College</option><option value="524">B.B College</option><option value="3939">B.B. Art's, N.B. Commerce & B.P. Science College, </option><option value="746">B.B.D.University,Lucknow</option><option value="4434">B.D.M Group Of Institutions</option><option value="4405">B.Ed students</option><option value="4583">B.K.Birla College, Kalyan,Maharashtra</option><option value="2718">B.L.D.E.A’s Dr. P. G. H. College of Engineering an</option><option value="4509">B.M. Institute of Technology and Management</option><option value="5020">B.M.shah pharmaceutical education and research</option><option value="4566">B.N MANDAL UNIVERSITY</option><option value="2805">B.N. College of Engineering and Technology , Luckn</option><option value="5162">B.R ambedkar Agra University </option><option value="4431">B.S. Abdur Rahman Crescent Institute of Science & </option><option value="399">B.S. Anangpuria Institute of Technology and Manage</option><option value="843">B.S.Abdur Rahman University</option><option value="1566">B.V.B. College of Engineering and technology</option><option value="3233">B.V.V.S. Polytechnic (Autonomous) Bagalkot, Karnat</option><option value="517">BABA  KUMA  SINGH  COLLEGE AMRITSAR</option><option value="1069">Baba Banda Singh Bahadur Engineering College</option><option value="3139">Baba Farid College</option><option value="3242">Baba Farid College of Engineering and Technology, </option><option value="1490">baba farid group of institutions,muktsar road,deon</option><option value="281">Baba Ghulam Shah Badshah University</option><option value="1952">Baba Hira Singh Bhattal Institute of Engg. & Tech.</option><option value="1828">Baba mastnath University,Rohtak</option><option value="228">Babaria Institute of Technolog, Varnama</option><option value="819">Babasaheb bhimrao ambedkar bihar university, bihar</option><option value="1893">Babasaheb Bhimrao Ambedkar University,Lucknow</option><option value="1929">Babasaheb Gawde Institute of Technology</option><option value="1757">Babasaheb Naik College of Engineering</option><option value="703">Babu Banarasi Das Institute of Technologhy</option><option value="190">Babu Banarasi Das National Institute of Technology</option><option value="2546">Babu Banarasi Das Northern India Institute of Tech</option><option value="1273">Babu Banarasi Das University Lucknow UP</option><option value="1504">Babu Banarsi Das Engineering College Lucknow </option><option value="1510">BABU BANARSI DAS ENGINEERING COLLEGE, LUCKNOW</option><option value="4956">BABU BANARSI DAS INSTITUTE OF ENGINEERING AND TECH</option><option value="702">BABU BANARSI DAS INSTITUTE OF TECHNOLOGY</option><option value="2972">Babu Madhav institute of Information Technology </option><option value="1221">Babu Madhav Institute of Information Technology, U</option><option value="3799">Babuda</option><option value="2688">Baburaoji Gholap college sangvi Pune</option><option value="1615">Baddi university of emerging sciences and technolo</option><option value="5051">Baderia Global Institute of Engineering and Manage</option><option value="1579">Bahra university</option><option value="3959">Bakhtiyarpur college of engineering</option><option value="3360">Bakhtiyarpur College of engineering</option><option value="2827">Balaji Institute of International Business</option><option value="1313">Ball State University</option><option value="596">Ballari Institute Of Technology and Management</option><option value="1334">Ballsbridge University</option><option value="528">Banaras Hindu University, Varanasi</option><option value="3047">Banarsidas Chandiwala Institute of Hotel Managemen</option><option value="52">BANARSIDAS CHANDIWALA INSTITUTE OF INFORMATION TEC</option><option value="2836">Banarsidas Chandiwala Institute of Professional St</option><option value="324">Banasthali University</option><option value="911">Banasthali Vidyapeeth</option><option value="4229">Bangalore institute of technology</option><option value="3011">Bangalore technological institute </option><option value="643">Bangalore University</option><option value="4507">Bangaluru Dr B R Ambedkar School of Economics Univ</option><option value="4685">Bangladesh Open University</option><option value="564">Bankalal badruka college for information technolog</option><option value="3990">Bankim Sardar College, West Bengal</option><option value="3571">Bankura Unnayani Institute Of Engineering</option><option value="451">Bannari Amman Institute Of Technology</option><option value="453">Bannari Amman Institute Of Technology</option><option value="452">Bannari Amman Institute Of Technology</option><option value="455">Bannari Amman Institute Of Technology</option><option value="456">Bannari Amman Institute Of Technology</option><option value="457">Bannari Amman Institute Of Technology</option><option value="458">Bannari Amman Institute Of Technology</option><option value="459">Bannari Amman Institute Of Technology</option><option value="460">Bannari Amman Institute Of Technology</option><option value="454">BANNARI AMMAN INSTITUTE OFTECHNOLOGY</option><option value="267">bansal institute of science & tech.,bhopal</option><option value="4463">Banwari Lal JINDAL SUIWALA COLLAGE</option><option value="2899">Bapatla Polytechnic College</option><option value="3606">Bapuji Institute of Engg & Technology</option><option value="1796">BAPURAO DESHMUKH COLLEGE OF ENGINEERING SEVAGRAM</option><option value="481">BAPURAO DESHMUKH COLLEGE OF ENGINEERING, SEVAGRAM</option><option value="4783">Barclays Global Service Centre</option><option value="4272">Barclays Global Service Centre</option><option value="2612">Barefoot collage international </option><option value="302">bareilly college bareilly</option><option value="1589">Barrackpore Rastraguru Surendranath Colege</option><option value="652">Basaveshwar Engineering College</option><option value="4107">Basic shiksha</option><option value="1875">Bayero University Kano</option><option value="368">BBA University</option><option value="701">bbdit</option><option value="3216">BCDA COLLEGE OF PHARMACY AND TECHNOLOGY</option><option value="4908">Bcm Arya model sr sec school </option><option value="3504">BCM Arya Model Sr. Sec. School,</option><option value="4611">BeAhead</option><option value="3557">BEAMSCAN COMMUNICATIONS Pvt Ltd</option><option value="1304">Beant College of Engg. and Technology, Gurdaspur</option><option value="4671">Belkuchi govt collage</option><option value="1025">Bengal College of Engg. & Technology, Durgapur, We</option><option value="3597">Bengal college of polytechnic</option><option value="468">Bengal Engineering and Science University Shibpur</option><option value="1756">Bennett University</option><option value="100">Berhampur University</option><option value="686">Beri Institute of Technology, Training & Research</option><option value="2577">BESANT THEOSOPHICAL COLLEGE</option><option value="3064">BGP Internet & Media Pvt. Ltd. </option><option value="3164">BGS Institute of Management studies  ,Chickballapu</option><option value="2958">BGS INSTITUTE OF TECHNOLOGY</option><option value="548">Bhabha Engineering Reasearch Institute (MCA), Bhop</option><option value="4358">Bhadrak Autonomous College, Bhadrak, Odisha</option><option value="2443">Bhagalpur College of Engineering,Bhagalpur</option><option value="5029">Bhagat Phool Singh Mahila Vishwavidyalay</option><option value="914">Bhagat Phool Singh Mahilla Vishwavidyalaya, Haryan</option><option value="2040">Bhagini Nivedita College, University of Delhi</option><option value="4534">Bhagirathi Vidyalaya</option><option value="246">Bhagwan Parshuram College of Engg.</option><option value="541">Bhagwan Parshuram Institute of Technology</option><option value="538">Bhagwant University, Ajmer</option><option value="2545">Bhagwati INSTITUTE of technology & Science, Ghazia</option><option value="4085">Bhai Gurdas Degree College, Sangrur </option><option value="1123">Bhai Gurdas Institute of Engineering & Technology,</option><option value="1897">Bhai Gurdas Institute Of Engineering And Technolog</option><option value="292">bhai parmanand institute of business studies</option><option value="989">Bhai Parmanand Institute of Business Studies, Delh</option><option value="4720">BHAILALBHAI AND BHIKHABHAI INSTITUTE OF TECHNOLOGY</option><option value="4533">Bharat college of science</option><option value="736">Bharat Electronics Limited</option><option value="2684">Bharat Institute of Engineering and Technology, Hy</option><option value="1229">Bharat Institute of technology</option> <option value="3207">Bharat Pharmaceutical Technology</option>
            <option value="3953">Bharat ratna indira gandhi college of engineering</option>
            <option value="3125">Bharat Sanchar Nigam Limited</option>
            <option value="3978">BHARAT TECHNOLOGY</option>
            <option value="4324">BHARATH INSTITUTE OF HIGHER EDUCATION AND RESEARCH</option>
            <option value="3297">Bharath Niketan Engineering College</option>
            <option value="1518">Bharath University</option>
            <option value="2820">BHARATHI WOMEN'S COLLEGE CHENNAI </option>
            <option value="895">BHARATHIAR UNIVERSITY</option>
            <option value="2795">BHARATHIDASAN GOVT.COLLEGE FOR WOMEN(AUTONOMOUS)</option>
            <option value="803">Bharathidasan University</option>
            <option value="3282">Bharathidasan University Constituent Arts & Scienc</option>
            <option value="3283">Bharathiyar College of Engineering and Technology</option>
            <option value="5078">Bharati College </option>
            <option value="80">BHARATI VIDYAPEETH</option>
            <option value="3808">Bharati Vidyapeeth (Deemed to be University) Insti</option>
            <option value="4983">Bharati Vidyapeeth (Deemed to be University)Colleg</option>
            <option value="1846">Bharati Vidyapeeth College Of Engg For Women</option>
            <option value="2161">Bharati Vidyapeeth College of Engineering</option>
            <option value="2164">Bharati Vidyapeeth College of Engineering</option>
            <option value="4326">Bharati Vidyapeeth Yashwantrao Mohite Institute of</option>
            <option value="1979">Bharati Vidyapeeth's College of Engg.</option>
            <option value="4015">Bharati Vidyapeeth's College of Pharmacy</option>
            <option value="1">Bharati Vidyapeeth's Institute of Computer Applica</option>
            <option value="4959">Bharati Vidyapeeth(Deemed To Be University) Colleg</option>
            <option value="3986">Bharati Vidyapeeth, Pune</option>
            <option value="210">BHARATI VIDYAPEETHS INTITUTE OF MANAGEMENT AND TEC</option>
            <option value="4924">Bharti Institute Pvt Ltd</option>
            <option value="3770">BHARTI VIDYAPEETH</option>
            <option value="32">Bharti Vidyapeeth's College Of Engineering</option>
            <option value="500">Bharti Vidyapeth,management institute, kolhapur</option>
            <option value="2469">Bhartividyapeeth</option>
            <option value="2942">Bhartiya Institute of Engineering & Technology</option>
            <option value="2658">BHASKARACHARYA COLLEGE OF APPLIED SCIENCES, UNIVER</option>
            <option value="2282">Bhausaheb Vartak Polytechnic</option>
            <option value="1967">Bhavan's Leelavati Munshi College of Education</option>
            <option value="1909">Bhavan's Shree H J Doshi IT Inst.-Jamnagar</option>
            <option value="3414">Bhavan's Vivekananda College</option>
            <option value="2544">Bhavans College Andheri West Mumbai-58</option>
            <option value="2622">Bhavdiya Educational Institute</option>
            <option value="4063">Bheemi Reddy Institute Of Management Science</option>
            <option value="3868">BHILAI INSTITUTE OF TECHNOLOGY,DURG</option>
            <option value="2730">Bhilai Institute of Technology, Durg</option>
            <option value="3088">Bhilai Institute of Technology,Raipur,Chhattisgarh</option>
            <option value="1028">Bhilai Steel Plant</option>
            <option value="1003">Bhimanna Khandre Inst of Technonolgy,Bhalki</option>
            <option value="1811">Bhivarabai sawant institute of technology and rese</option>
            <option value="3937">Bhoj Reddy Engineering College for Women</option>
            <option value="4450">Bhola Paswan Shastri Agricultural College Purnea</option>
            <option value="2768">Bholanath College, Dhubri</option>
            <option value="2760">Bholanath College, Dhubri</option>
            <option value="2761">Bholanath College, Dhubri</option>
            <option value="2763">Bholanath College, Dhubri</option>
            <option value="2764">Bholanath College, Dhubri</option>
            <option value="2765">Bholanath College, Dhubri</option>
            <option value="3607">Bhubanananda Orissa School of Engineering</option>
            <option value="4897">Bhubaneswar Engineering College, Bhubaneswar, Odis</option>
            <option value="3439">Bidhan chandra krishi viswavidyalaya</option>
            <option value="1318">Bidhan Chandra Krishi Viswavidyalaya </option>
            <option value="3702">Biet.</option>
            <option value="1366">Biff & Bright College of Engineering & Technology</option>
            <option value="3390">Bihar Institute of Law</option>
            <option value="781">Bihar Institute of Public Administration and Rural</option>
            <option value="3936">Bihar National College</option>
            <option value="2539">BIJNI COLLEGE, BIJNI </option>
            <option value="4075">Bijupattanayak Institute of IT and Management Stud</option>
            <option value="3598">Bimla Devi Educational Society Group of institutio</option>
            <option value="4473">Bineswar Brahma Engineering College</option>
            <option value="544">binip chandra tripathi, kumaun engineering college</option>
            <option value="3950">BINOD BIHARI MAHATO KOYALANCHAL UNIVERSITY, DHANBA</option>
            <option value="4277">BIOCARE techno </option>
            <option value="3544">Bipin Tripathi Kumaon Institute of Technology Dwar</option>
            <option value="4241">Bipradas Pal Chowdhury Institute of Technology</option>
            <option value="3830">Birla Global University</option>
            <option value="112">Birla Insitute of Technology,Mesra,Extension centr</option>
            <option value="205">Birla Institute of Applied Sciences</option>
            <option value="4348">Birla Institute of Management Technology</option>
            <option value="950">Birla institute of Technology and Science</option>
            <option value="3633">Birla Institute of Technology and Science Pilani, </option>
            <option value="116">Birla Institute of Technology, Ext. Center, Jaipur</option>
            <option value="1507">Birla Institute of Technology, Mesra</option>
            <option value="1306">Birla Institute of Technology, Mesra, Noida Campus</option>
            <option value="234">BIRLA NSTITUTE OF TECHNOLGY,MESRA,RANCHI-835215</option>
            <option value="4761">Birla Shiksha Kendra Chittorgarh</option>
            <option value="1474">Birla Vishvakarma Mahavidyalaya College</option>
            <option value="841">BISAG</option>
            <option value="3800">BISHOP CONRAD SR. SEC. SCHOOL, BAREILLY</option>
            <option value="3817">Bishop cottons women’s Christian law college </option><option value="4864">BISHOP HEBER COLLEGE</option><option value="3983">BISHOPMOORE COLLEGE</option><option value="690">BIT Kolkata</option><option value="633">BIT Mesra Kolkata Ext Centre</option><option value="2337">BIT Sindri Dhanbad</option><option value="2706">BIT Sindri Dhanbad</option><option value="1426">BITS PILANI - K.K Birla Goa Campus</option><option value="3325">Biyani group of colleges, Jaipur</option><option value="4604">BJGMC</option><option value="4781">Black Diamond College Of Engineering and Technolog</option><option value="709">Blink Consulting Pvt Ltd</option><option value="1661">BML Munjal University</option><option value="503">BMS College of Engineering, Bangalore, Karnataka (</option><option value="4336">BMS Institute of Technology and Management</option><option value="1626">BMS INSTITUTE OF TECHNOLOGY AND MANAGEMENT</option><option value="1007">BMSIT, Bangalore (INDIA)</option><option value="4953">BNM Institute of Technology</option><option value="4136">Bodoland university</option><option value="4137">Bodoland university</option><option value="3807">BOILER COMPANY SAHARANPUR</option><option value="4392">Bombay Scottish </option><option value="809">Bonam Venkata Chalamiah Engg Collge</option><option value="3928">Bongaigaon Polytechnic</option><option value="925">BORDER SECURITY FORCE  POLYTECHNIC </option><option value="4293">Boys Higher Secondary zadibal</option><option value="1495">BPUT Odisha</option><option value="2105">BRAANET TECHNOLOGIES PVT. LTD.</option><option value="3700">BRAC University</option><option value="3882">Brahma Valley College of Engineering & Research In</option><option value="3217">Brainware university</option><option value="3413">Brainware University</option><option value="2475">brainwonders</option><option value="1650">BRCM College of Engineering and Technology</option><option value="4204">Brihan Maharashtra College of Commerce </option><option value="1841">Brihanmumbai Electric Supply & Transport Undertaki</option><option value="4917">Bringle Excellence UK & India</option><option value="4005">Brisk Seeker</option><option value="4378">Broadcast Enginnering Consultants India Limited</option><option value="253">BRS INSTRUMENTS PVT. LTD.,</option><option value="4868">BSA College of Engineering and Technology</option><option value="3572">BSF Polytechnic</option><option value="1844">BUDDHA INSTITUTE OF TECHNOLOGY</option><option value="1795">Buddha Institute of Technology</option><option value="1452">Budge Budge Institute of Technology</option><option value="4517">Budha pg College Kushinagar</option><option value="3641">BUILDERS ENGINEERING COLLEGE</option><option value="1389">Bundelkhand University, Jhansi</option><option value="1760">Bundelkhand University, Jhansi</option><option value="2988">Bunts Sangha's Anna Leela College</option><option value="1581">Buraidah College of Technology</option><option value="590">burdwan university</option><option value="4637">Business</option><option value="263">Business Objects(SAP)</option><option value="4000">Buxi jagabandhu bidyadhar autonomous college</option><option value="4941">BVRIT Hyderabad College of Engineering for Women</option><option value="4942">BVRIT Hyderabad College of Engineering for Women</option><option value="2877">BVRIT Hyderabad College of Engineering for Women</option><option value="333">BYK College, Nashik-02</option><option value="3883">C SREE RAMKRISHNA TTCR</option><option value="767">C U Shah College</option><option value="1117">C U Shah University</option><option value="3184">C V RAMAN GLOBAL UNIVERSITY, BHUBANESWAR</option><option value="723">C-DOT</option><option value="1272">C. V. RAMAN COLLEGE OF ENGINEERING (AUTONOMOUS)</option><option value="1031">C.B.Patel Computer College</option><option value="2736">C.m.science college Darbhanga bihar</option><option value="3438">CA Firm</option><option value="999">Cairo Univ.</option><option value="1185">Cairo University</option><option value="3517">Calcutta Institute Of Enginnering And Management</option><option value="1423">Cambridge Institute of Technology</option><option value="5065">Cambridge International School Jammu </option><option value="924">CAMELLIA INSTITUTE OF TECHNOLOGY </option><option value="1465">CAMELLIA SCHOOL OF ENGINEERING AND TECHNOLOGY</option><option value="3309">Campion School</option><option value="3501">Canara Engineering College</option><option value="3502">Canara Engineering College</option><option value="3491">Canara Engineering College</option><option value="3492">Canara Engineering College</option><option value="3493">Canara Engineering College</option><option value="3494">Canara Engineering College</option><option value="136">Cap Gemini</option><option value="2670">Capgemini</option><option value="3996">Cardamom Planters Association College</option><option value="546">Career College, Bhopal</option><option value="1035">career point university</option><option value="4313">Caritas University Amorji Nike Enugu</option><option value="3539">CATHOLICATE COLLEGE PATHANAMTHITTA, KERALA</option><option value="2853">Cauvery College for Women (Autonomous)</option><option value="1350">CBP GOVT. ENGG. COLLEGE JAFFARPUR,DELHI</option><option value="1075">CBS Group of Institutions</option><option value="1898">CBSE</option><option value="2927">Cchatrapati shivaji maharaj institute of technolog</option><option value="4342">CCS Haryana Agricultural University, Hisar </option><option value="1363">CCS Meerut</option><option value="83">cdlu sirsa</option><option value="1205">Ceasefire Industries Ltd</option><option value="4408">Cebu Institute of Technology University</option><option value="1212">Center for AI and Robotics</option><option value="2737">Center for Global Knowledge </option><option value="936">Center for Railways Information Systems</option><option value="1394">Center for Research of E-life DIgital Technology</option><option value="2390">CENTER OF ADVANCED PG STUDIES,BPUT</option><option value="4865">CENTRAL ACADEMEY</option><option value="3076">Central Agricultural University Imphal</option><option value="903">CENTRAL BANK OF INDIA</option><option value="642">Central College of Engineering & Technology</option><option value="1348">Central Council for Research in Ayurvedic Sciences</option><option value="574">Central Drug Research Institute</option><option value="1211">Central Electronics Engineering Research Institute</option><option value="3593">CENTRAL HINDU BOYS SCHOOL BHU KAMACHHA VARANASI</option><option value="1396">Central Industry Research & Service Division, Inst</option><option value="4869">Central Institute of Business Management, Research</option><option value="1110">Central Institute of plastic engineering and techn</option><option value="2481">Central Institute Of Technology, Kokrajhar</option><option value="1468">Central Mechanical Engineering Research Institute</option><option value="1502">Central Mechanical Engineering Research Institute</option><option value="586">Central Pollution Control Board</option><option value="1903">Central Research Laboratory</option><option value="4795">Central Research Laboratoy Bharat Electronics Limi</option><option value="1278">Central university of Assam</option><option value="1045">CENTRAL UNIVERSITY OF BIHAR PATNA</option><option value="831">Central University of Haryana</option><option value="2672">Central University of Himachal Pradesh</option><option value="1114">Central University of Jammu</option><option value="1438">Central University of Karnataka</option><option value="4213">Central University of Kashmir</option><option value="2963">central university of odisha</option><option value="1573">CENTRAL UNIVERSITY OF PUNJAB</option><option value="799">Central University of Rajasthan</option><option value="3266">Central University of South Bihar, Government of I</option><option value="3562">Central Water and Power Research Station</option><option value="1414">Centre for Air Power Studies</option><option value="1812">Centre for Computers and Communication Technology</option><option value="19">Centre for Development of Advanced Computing</option><option value="876">Centre For Development Of Advanced Computing</option><option value="1654">Centre for DNA Finger printing and Diagnostics</option><option value="2044">Centre for Good Governance</option><option value="3326">Centurion University of Technology and Management</option><option value="3507">CEPT University</option><option value="303">cert, meerut</option><option value="1333">CGC College of Engineering Landran</option><option value="2878">CGC Landran</option><option value="1660">CGI Information systems and management services</option><option value="695">CH Institute of management and commerce</option><option value="4560">Ch Ranbir Singh State Institute of Engineering and</option><option value="1960">Ch. Brahm Prakash Government Engineering College</option><option value="3871">Chadalawada Ramanamma Engineering College (Autonom</option><option value="2444">Chaibasa Engineering College Chaibasa</option><option value="4497">Chaitan Sadhan Institute of Science and Technology</option><option value="2291">Chaitanya Bharathi Institute of Technology</option><option value="2605">CHAITANYA INSTITUTE OF TECHNOLOGY AND SCIENCES </option><option value="948">Chameli devi institute of engineering</option><option value="439">Chameli Devi Institute of tehnology and management</option><option value="4639">Chanakya National Law University</option><option value="4447">Chanakya Software Services Pvvt Ltd</option><option value="2272">ChanderPrabhu Jain College of Higher Studies & Sch</option><option value="260">Chandigarh College of Engineering and Technology,C</option><option value="770">Chandigarh Engg. College</option><option value="559">Chandigarh Engineering College,Landran</option><option value="1310">Chandigarh Group Of Colleges,Jhanjeri</option><option value="5072">Chandigarh University</option><option value="5073">Chandigarh University</option><option value="1965">Chandigarh University Gharuan</option><option value="1244">Chandigarh University, Gharuan,Mohali, Punjab</option><option value="4021">Chandra Shekhar Azad University of Agriculture and</option><option value="929">Chandubhai S Patel Institute of Technology</option><option value="118">Charotar Institute of Technology, Changa</option><option value="997">Charotar University of Science and Technology</option><option value="4620">charuchandra college</option><option value="5100">Chaudhary Bansi Lal University</option><option value="4042">CHAUDHARY CHARAN SINGH UNIVERSITY</option><option value="3753">Chaudhary Devi Lal University</option><option value="3867">Chennai National Arts And Science College</option><option value="2264">Chennai National Arts and Science College</option><option value="2728">Cheran College of Engineering</option><option value="996">Chettinad College of Engineering & Technology, Tam</option><option value="3162">Chhatrapati Shahu Ji Maharaj University, KANPUR </option><option value="3861">Chhatrapati Shivaji Institute of Technology, Durg</option><option value="1549">Chhotu Ram College</option><option value="3168">Chhotu Ram Rural Institute Of Technology</option><option value="3915">Chhotubhai Gopalbhai Patel Institute of Technology</option><option value="3906">Chief Khalsa Diwan Institute of Management & Techn</option><option value="1292">Chikkanna Govt. Arts College</option><option value="4669">Children College </option><option value="825">Chilkur Balaji Institute of Technology</option><option value="4307">Chinmaya Institute of Technology</option><option value="3411">Chinmaya Vishwavidyapeeth</option><option value="4883">Chintamanrao Institute Of Management & Development</option><option value="2808">Chip Web Technologies</option><option value="1644">Chirala Engineering College</option><option value="1704">chiranjeevi reddy institute of engg&tech,anantapur</option><option value="488">Chitkara Institute of Engineering and Technology</option><option value="1152">Chitkara University</option><option value="4786">Chitkara University Institute of Engineering and T</option><option value="4784">Chitkara University-rajpura campus</option><option value="3837">Chittagong University of Engineering & Technology</option><option value="4022">Cholistan University</option><option value="4551">Chouksey Engineering College </option><option value="4550">Chouksey group of college </option><option value="4547">Chouksey group of college </option><option value="4548">Chouksey group of college </option><option value="4549">Chouksey group of college </option><option value="4541">Chouksey group of college </option><option value="4542">Chouksey group of college </option><option value="4543">Chouksey group of college </option><option value="4544">Chouksey group of college </option><option value="4545">Chouksey group of college </option><option value="1353">Chowgule College of Arts and Science</option><option value="2292">CHRIST (Deemed to be University), Bangalore</option><option value="1840">Christ College</option><option value="4927">Christ College of Engineering and Technology</option><option value="4923">Christ the king Engineering college</option><option value="4444">Christ University</option><option value="1764">Christ University</option><option value="326">Christ University, Bangalore</option><option value="4369">Christian college of engineering &technology </option><option value="137">Christu Jyoti Institute of Tech & Science,Jangaon</option><option value="2716">Christu Jyoti Institute of Technology &Science, </option><option value="359">ChristuJayanthiJubileeCollege,VidyaNagar,Guntur</option><option value="808">Chung Hua University</option><option value="2365">Cihan University, Erbil</option><option value="557">ciit</option><option value="3098">CIRCUIT BENCH OF CALCUTTA HIGH COURT</option><option value="1770">CiRG, CIRS</option><option value="3485">CitiusTech</option><option value="3370">City College</option><option value="3419">City engeering college</option><option value="5">City Montessori School & Degree College</option><option value="4886">CITY PREMIER COLLEGE</option><option value="2675">City University, Malaysia</option><option value="1745">Cloud Industry </option><option value="893">Cluster Innovation Centre</option><option value="3432">Cluster University</option><option value="2747">Cluster University Srinagar</option><option value="152">CMC Limited</option><option value="2128">CMR College of Engineering and Technology</option><option value="3391">CMR Engineering College </option><option value="435">CMR INSTITUTE OF MANAGEMENT STUDIES</option><option value="777">CMR Institute of Technology</option><option value="3199">CMR Technical Campus</option><option value="3760">CMR UNIVERSITY</option><option value="757">CMS College of Engineering</option><option value="4276">CMS Govt. Girls polytechnic Daurala Meerut</option><option value="3285">COE</option><option value="4771">COGNIZANT</option><option value="45">Cognizant Technology Solutions</option><option value="3508">Coimbatore Institute of Technology</option><option value="2384">Coimbatore Institute of Technology</option><option value="1848">collabera technologies private limited</option><option value="1994">College</option><option value="3348">College</option><option value="1553">College of Agricultural Engineering and Post Harve</option><option value="852">College of Applied Sciences</option><option value="3369">College of Commerce, Arts & Science, Patna</option><option value="3099">College of Community and Applied Sciences, Maharan</option><option value="4012">College of Community Science</option><option value="2721">College of Computer & Management</option><option value="592">College Of Computer Appliocation For Women ,Satara</option><option value="856">College of CS & IS, Jazan, KSA, Jazan University</option><option value="3617">College of Dairy Science and Food Technology</option><option value="2524">COLLEGE OF EDUCATION</option><option value="4301">College of Engineering & Management, Kolaghat</option><option value="157">College of Engineering & Technology</option><option value="3335">college of engineering and management, kolaghat</option><option value="573">college of engineering and rural technology,meerut</option><option value="2033">College of Engineering and Technology,Bhubaneswar</option><option value="3852">College of engineering kidangoor</option><option value="3039">College of Engineering Muttathara</option><option value="1016">COLLEGE OF ENGINEERING PUNE</option><option value="92">College of Engineering Roorkee</option><option value="3396">college of engineering vadakara</option><option value="984">College of Fisheries</option><option value="603">College of Management & Computer Application Teert</option><option value="3918">College of Pharmaceutical Sciences Puri</option><option value="1274">College of Science & Engineering, Jhansi</option><option value="1335">College of Science and Technology</option><option value="2869">College of Technology and Engineering, MPUAT,Udaip</option><option value="3312">College Of Technology, Pantnagar</option><option value="5074">College of vocational studies </option><option value="4516">COLLEGE STUDENT</option><option value="3225">collge</option><option value="4050">Columbia Institute of Pharmacy</option><option value="954">Comm-IT</option><option value="2231">CompuCom  Institute of Information and Mannagement</option><option value="1271">Computational Intelligence Research Group</option><option value="2024">Computer Centre, M/o Statistics & PI</option><option value="956">Computer Centre,Ministry of Statistics & Programme</option><option value="2759">Computer Society of India</option><option value="2755">Computer Society of India</option><option value="2756">Computer Society of India</option><option value="2757">Computer Society of India</option><option value="4185">Comsats Islamabad</option><option value="1161">Concentrix India Pvt Ltd</option><option value="4109">Contai Polytechnic (Govt. of West Bengal)</option><option value="2713">Continuity & Resilience</option><option value="220">Convergys Information Management Group</option><option value="4404">CoreCentric Engineering Solutions India Pvt Ltd </option><option value="3625">Cornell University </option><option value="3510">CORPORATE INSTITUTE OF SCIENCE AND TECHNOLOGY BHOP</option><option value="3511">Corporate institute of Science and Technology BHOP</option><option value="2862">Cotton Unuveraity,Assam</option><option value="2100">Cranfield University United Kingdom</option><option value="3767">Creane memorial high school </option><option value="3972">Creative Convent Higher Secondary School Tikamgarh</option><option value="4631">Criminal Investigation Department (CID), WB</option><option value="1645">Crooked Fox</option><option value="1659">Crooked Fox PLC</option><option value="3661">csc cnter</option><option value="2477">CSC e-Governance Services India Limited</option><option value="4188">CSI college of engineering </option><option value="3004">CSI Ghaziabad Chapter</option><option value="2821">CSI INSTITUTE OF TECHNOLOGY, THOVALAI</option><option value="3575">CSI Wesley Institute of Technology and Sciences</option><option value="1559">CSIR Central Scientific Instruments Organisation</option><option value="725">CSIR-Central Electronics Engineering Research Inst</option>
            <option value="2961">CSIR-Central Food Technological Research Institute</option>
            <option value="3963">CSIR-NISCAIR</option>
            <option value="1938">CSIR-NISTADS</option>
            <option value="2668">CSIR-Structural Engineering Research Centre</option>
            <option value="3832">CSMSS Chh Shahu College of Engineering</option>
            <option value="4379">CSMSS Chh. Shahu College of Engineering</option>
            <option value="1435">CSMSS Chh. Shahu College of Engineering, Aurangaba</option>
            <option value="3043">CSVTU, Bhilai</option>
            <option value="3525">Ct college of institutions </option>
            <option value="964">CT Institute of engineering & management technolog</option>
            <option value="2829">CT University, Ludhiana</option>
            <option value="2300">cummins college of engg for women, Pune</option>
            <option value="81">CVR COLLEGE OF ENGINEERING</option>
            <option value="591">CYBER COPS India</option><option value="4594">Cyber Forensics & Criminal Investigation Departmen</option><option value="2089">Cyber Peace Foundation</option><option value="4124">Cyberjuris - Law Firm</option><option value="1624">CyberQ Consulting Pvt. Ltd.</option><option value="2008">CyberSecurityDelhi</option><option value="2680">D A V Mahavidyalaya</option><option value="2796">D S Dinakar National Polytechnic </option><option value="3075">D Y PATIL COLLEGE OF ENGINEERING AKUDI PUNE</option><option value="1021">D Y PATIL INST</option><option value="2518">D Y Patil International University</option><option value="2520">D Y Patil International University</option><option value="2521">D Y Patil International University</option><option value="2542">D Y Patil International University, Pune</option><option value="2603">D Y Patil International University, Pune</option><option value="4889">D Y Patil School of Engineering and Technology Amb</option><option value="4999">D. A. V(PG) college </option><option value="3220">D. K. Govt. College for Women (A), Nellore</option><option value="1706">D. Y. Patil College Of Engineering & Technology, K</option><option value="4356">D.A.V BOYS SR.SEC. SCHOOL</option><option value="3093">D.A.V COLLEGE HOSHIARPUR PUNJAB</option><option value="1266">D.A.V. College ( Lahore ) </option><option value="1525">D.A.V.College, Jalandhar City , Punjab</option><option value="1575">D.A.V.PG college,kanpur</option><option value="4474">D.B.J.college</option><option value="1604">D.G.Ruparel College</option><option value="1497">D.G.Ruparel College</option><option value="1447">D.J Sanghvi College of Engineering</option><option value="886">D.J.Sanghvi COllege of Engineering</option><option value="3583">D.K.T.E.S., TEXTILE AND ENGINEERING INSTITUTE</option><option value="2482">D.N.Jain College, Jabalpur (M.P)</option><option value="674">DAC Chandrapur</option><option value="3252">Dadasaheb Mokashi college of Food Technology, Rajm</option><option value="3828">Dadasaheb Patil College of Agriculture, Dahegaon, </option><option value="2587">Dadi Institute of Engineering and Technology,Anaka</option><option value="4182">Daffodil International University</option><option value="2321">Dahiwadi College Dahiwadi, Maharashtra, India.</option><option value="3566">Dakshin Dinajpur Krishi Vigyan Kendra, Uttar Banga</option><option value="2357">DAKSHIN GUWAHATI B.ED. COLLEGE</option><option value="2695">Daleep valse patil art science and commerce colleg</option><option value="4713">Damodaram Sanjivayya National Law University</option><option value="3647">Danalekshmi Srinivasan College of Engineering &Tec</option><option value="2326">Dandekar college</option><option value="3321">Darbhanga college of engineering</option><option value="1631">Darshan institute </option><option value="3474">Dasari Rama Kotayya COllage of Engineering and Tec</option><option value="2344">Dashmesh khalsa college</option><option value="527">Dasient</option><option value="5106">Dasmesh College of Pharmacy</option><option value="5107">Dasmesh College of Pharmacy</option><option value="5108">Dasmesh College of Pharmacy</option><option value="4299">DASMESH INSTITUTE OF RESEARCH AND DENTAL SCIENCES,</option><option value="1364">Datta Meghe Institute of Engineering, Technology &</option><option value="2896">DATTA MEGHE INSTITUTE OF MANAGEMENT STUDIES</option><option value="2571">Dattajirao Kadam Arts, Science and Commerce Colleg</option><option value="4753">DAV BOYS SENIOR SECONDARY SCHOOL</option><option value="1483">DAV Centanary College</option><option value="764">DAV Centenary Public School</option><option value="2966">Dav college Amritsar </option><option value="1260">DAV College for Girls Yamunanagar</option><option value="3091">DAV College Hoshiarpur </option><option value="3127">DAV College Jalandhar</option><option value="4016">DAV College, Abohar</option><option value="4891">DAV Engineering Institute daltanganj palamu jharkh</option><option value="366">DAV Institute of Engineering and Technology, Jalan</option><option value="194">DAV Institute of Management</option><option value="4874">DAV Public School, Sreshtha Vihar, Delhi - 110092</option><option value="3961">DAV School of Business Management</option><option value="1980">DAV University Jalandhar</option><option value="2794">DAYALBAGH EDUCATIONAL INSTITUTE</option><option value="920">Dayalbagh Educational Institute</option><option value="3940">DAYANAND ACADEMY OF MANAGEMENT STUDIES</option><option value="2590">Dayanand Science College, Latur</option><option value="3284">Dayananda Sagar Academy of Technology and Manageme</option><option value="168">Dayananda Sagar College of Engineering</option><option value="2487">Dayananda Sagar Univeristy</option><option value="172">DCA CUSAT</option><option value="1803">Debasis jana</option>
			
        </select>
    </div>
    
    <div class="form-group">
        <label for="category">Category:</label><br>
        <select id="category" name="category" required>
            <option value="Research Scholar">Research Scholar</option>
            <option value="Full-time Student">Full-time Student</option>
            <option value="Faculty">Faculty</option>
            <option value="Industry Representative">Industry Representative</option>
        </select>
    </div>

    <div class="form-group">
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <p style="color:grey ; font-size:15px"> **I hereby convey my consent to receive information about the activities of the institution by email or by SMS on my Mobile number, from time to time, by the Institution.</p><br>
        
        <input type="submit" value="Add">
      </form>

</div>


<footer>
    <div class="footer">
        Copyright ©2024 BVICAM , New Delhi | All rights reserved

    </div>  
</footer>




</body>
</html>
