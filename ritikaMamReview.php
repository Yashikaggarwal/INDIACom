<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include('dbconnect.php');

    // Get form data
    $paper_id = $_GET['paper_id'] ?? null;
    $paper_status = $_POST['paper_status'] ?? null;
    $extra_page_count = $_POST['extra_page_count'] ?? null;
    $review_remarks = $_POST['review_remarks'] ?? null;

    // Validate paper_id and paper_status
    if ($paper_id && $paper_status) {
        // SQL query to update data in the paper table
        $sql = "UPDATE paper SET PaperStatus=?, ExtraPageCount=?, ReviewRemarks=? WHERE PaperID=?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ssss", $paper_status, $extra_page_count, $review_remarks, $paper_id);

            // Execute the statement
            if ($stmt->execute()) {
                // Check if the paper status requires redirection
                if ($paper_status == "Accepted after Detailed Review" || $paper_status == "Accepted without IEEE Xplore") {
                    // Redirect to ritikaMam.php
                    echo "Mail triggers to Acceptance Incharge";
                    exit(); // Ensure that no further code is executed
                } else {
                    // Redirect to adminReview.php
                    echo "Mail triggers to Author";
                    exit(); // Ensure that no further code is executed
                }
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Invalid paper ID or paper status.";
    }

    // Close the database connection
    $conn->close();
}
?>



<?php
// Include your database connection file here
include('dbconnect.php');

// Check if the 'paper_id' parameter is set in the URL
if (isset($_GET['paper_id'])) {
    // Get the PaperID from the URL parameter
    $paper_id = $_GET['paper_id'];

    // Query to fetch paper details
    $paper_details_sql = "SELECT paper.*, user.MemberID AS MainAuthorID , user.Name AS MainAuthorName, user.Email AS MainAuthorEmail, user.Mobile AS MainAuthorMobile
                        FROM paper
                        INNER JOIN user ON paper.MemberID = user.MemberID
                        WHERE paper.PaperID = $paper_id";

    // Query to fetch co-authors details
    $author_details_sql = "SELECT author.*, user.Name, user.Email, user.Mobile
                            FROM author
                            INNER JOIN user ON author.MemberID = user.MemberID
                            WHERE author.PaperID = $paper_id";

    // Execute paper details query
    $paper_details_result = $conn->query($paper_details_sql);

    // HTML structure to display paper and author details
    ?>



    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Paper Details</title>
        <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 5px;
  /* overflow: hidden; */
  border: 1px solid #ddd; /* Add border to the table */
  margin-top: 10px; /* Add margin to separate from .info-container */
}

th, td {
  padding: 10px;
  border: 1px solid #ddd;
}

th {
  font-weight: bold;
  text-align: left;
}

textarea {
  resize: vertical;
}

.info-container {
  margin-top: 10px;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border: 1px solid #ddd; /* Moved from table to .info-container */
  border-radius: 5px;
}

h1, h3 {
  color: #333;
  margin-bottom: 10px;
}

p {
  margin-left: 5px;
  margin-bottom: 2px;
  text-align: left;
}

select,
input[type="text"],
input[type="file"] {
  display: inline;
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}

input[type="submit"],
input[type="reset"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
  background-color: #07273b;
}

th,
td,
select,
input[type="text"],
input[type="file"] {
  border-color: #444;
}

input[type="submit"],
input[type="reset"] {
  background-color: #6CA0DC;
}

</style>


        <!-- Include any CSS stylesheets or Bootstrap if needed -->
    </head>
    <body>
    <div class="page-header-background">
        <div class="page-header-path">
            <a href="login.html" id="home-page">
                Home
            </a>
            <p>/</p>
            <a href="login.html" id="login-page">
                Admin Home
            </a>
        </div>
        <div class="page-header-heading">
            <h1>ADMIN HOME</h1>
        </div>
    </div>

        <div class="info-container" >
            <h1 style="text-align: center;">Paper Details</h1>
            <?php
            if ($paper_details_result->num_rows > 0) {
                // Fetch paper details
                $paper_details_row = $paper_details_result->fetch_assoc();
                ?>
                
                <p style="color: #07273b; font-weight: bold;">Event: <?php echo $paper_details_row['Event']; ?></p>
                <p style="color: #07273b; font-weight: bold;">Title: <?php echo $paper_details_row['Title']; ?></p>
                <p style="color: #07273b; font-weight: bold;">Track: <?php echo $paper_details_row['Track']; ?></p>
                <br><br>
           
                <!-- Display co-authors details -->
                <h3>Authors</h3>
                <table border="1">
                    <tr>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                    </tr>

                    <tr>
                <td><?php echo $paper_details_row['MainAuthorID'];?></td>
                <td><?php echo $paper_details_row['MainAuthorName']; ?></td>
                <td><?php echo $paper_details_row['MainAuthorEmail']; ?></td>
                <td><?php echo $paper_details_row['MainAuthorMobile']; ?></td>
            </tr>
                    <?php
                    // Execute co-authors details query
                    $author_details_result = $conn->query($author_details_sql);

                    if ($author_details_result->num_rows > 0) {
                        // Fetch and display co-authors details
                        while ($author_details_row = $author_details_result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $author_details_row['MemberID']; ?></td>
                                <td><?php echo $author_details_row['Name']; ?></td>
                                <td><?php echo $author_details_row['Email']; ?></td>
                                <td><?php echo $author_details_row['Mobile']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>No co-authors found.</td></tr>";
                    }
                    ?>
                </table>
                <!-- Display other paper details as needed -->
                <p>Paper:
    <form action='render_pdf.php' method='post' target='_blank' style="display: inline;">
        <input type='hidden' name='pdfData' value='<?php echo base64_encode($paper_details_row["PaperPDF"]); ?>'>
        <button type='submit'>View PDF</button>
    </form>
</p>
<p>Presentation PDF:
    <form action='render_pdf.php' method='post' target='_blank' style="display: inline;">
        <input type='hidden' name='pptData' value='<?php echo base64_encode($paper_details_row["PresentationPDF"]); ?>'>
        <button type='submit'>View PDF</button>
    </form>
</p>
<p>CRC (DOC/DOCX):
    <form action='render_pdf.php' method='post' target='_blank' style="display: inline;">
        <input type='hidden' name='CRCData' value='<?php echo base64_encode($paper_details_row["CRC"]); ?>'>
        <button type='submit'>View PDF</button>
    </form>
</p>
<p>C Originality:
    <form action='render_pdf.php' method='post' target='_blank' style="display: inline;">
        <input type='hidden' name='CORGData' value='<?php echo base64_encode($paper_details_row["COriginality"]); ?>'>
        <button type='submit'>View PDF</button>
    </form>
</p>
<p>Copyright Transfer:
    <form action='render_pdf.php' method='post' target='_blank' style="display: inline;">
        <input type='hidden' name='copyrightData' value='<?php echo base64_encode($paper_details_row["CopyrightTransfer"]); ?>'>
        <button type='submit'>View PDF</button>
                </form></p><br>
             
        <form method="POST">
            <label  for="paper_status">Paper Status:</label>
            <select name="paper_status" id="paper_status">
            <option value="Accepted after Detailed Review">Accepted after Detailed Review</option>
            <option value="Accepted without IEEE Xplore">Accepted without IEEE Xplore</option>

            
            <!-- Add more options as needed -->
        </select>
            <br>
            
            <label for="review_remarks" style="font-size: 16px; display: inline-block; vertical-align: top;">Review Remarks: </label>
            <textarea id="review_remarks" name="review_remarks" style="width: 500px; height: 250px; vertical-align: top;"></textarea>
            <br><br>

            <label for="review_remarks_file">Review Remarks File (PDF Format Only): </label>
            <input type="file" id="review_remarks_file" name="review_remarks_file" accept=".doc, .docx, .pdf" >
            
                
        <!-- Existing form elements -->

        <p>
            <input type="submit" value="Submit" name="B1">&nbsp;&nbsp;
            <input type="reset" value="Reset" name="B2">
        </p>
        <br><br>
                </form>
        
            <?php
            } else {
                // No paper found with the provided PaperID
                echo "<p>Paper not found.</p>";
            }
            ?>
        </div>
        <?php
} else {
    // No PaperID parameter provided in the URL
    echo "PaperID parameter is missing.";
}

// Close the database connection
$conn->close();
?>


    </body>
    </html>
    
