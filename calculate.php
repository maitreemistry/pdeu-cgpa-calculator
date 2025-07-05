<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .subject {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="number"] {
            width: calc(50% - 10px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: inline-block;
        }
        button, input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            background: #007BFF;
            color: #fff;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover, input[type="submit"]:hover {
            background: #0056b3;
        }
        #subjects {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>CGPA Calculator</h1>
    <form action="calcuate.php" method="post">
        <div id="subjects">
            <div class="subject">
                <label for="marks[]">Enter Subject Marks: </label>
                <input type="number" name="marks[]" required>
                <label for="credits[]">Enter number of credits: </label>
                <input type="number" name="credits[]" required>
                <label for="subject_name[]">Subject Name: </label>
                <input type="text" name="subject_name[]" required>
            </div>
        </div>
        <button type="button" onclick="addSubject()">Add Another Subject</button>
        <br><br>
        <input type="submit" value="Calculate CGPA">
    </form>

    <script>
        function addSubject() {
            var subjectsDiv = document.getElementById("subjects");
            var newSubjectDiv = document.createElement("div");
            newSubjectDiv.classList.add("subject");
            newSubjectDiv.innerHTML = `
                <label for="marks[]">Enter Subject Marks: </label>
                <input type="number" name="marks[]" required>
                <label for="credits[]">Enter number of credits: </label>
                <input type="number" name="credits[]" required>
                <label for="subject_name[]">Subject Name: </label>
                <input type="text" name="subject_name[]" required>
            `;
            subjectsDiv.appendChild(newSubjectDiv);
        }
    </script>


</body>
</html>


<?php
function getPointer($z) {
    if ($z >= 80) {
        return 10;
    } elseif ($z >= 70) {
        return 9;
    } elseif ($z >= 65) {
        return 8;
    } elseif ($z >= 60) {
        return 7;
    } elseif ($z >= 55) {
        return 6;
    } elseif ($z >= 50) {
        return 5;
    } elseif ($z >= 45) {
        return 4;
    } elseif ($z >= 40) {
        return 3;
    } else {
        return 0;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marks = $_POST['marks'];
    $credits = $_POST['credits'];
    $subj = $_POST['subject_name'];
    $n = count($marks);

echo "<table><th><td>Subject Name: </td><td> </td><td> Marks </td><td> Credits </td><td> Pointer </td></th></table>";

    $g=0;
	foreach ($marks as $x) {
        $u=getPointer($marks[$g]);
       echo  "<table> <tr><td> $subj[$g]: </td><td> </td><td> $x </td><td> $credits[$g] </td><td> $u </td></tr></table>";
	   $g++;
    }

    $sum = 0;
    for ($j = 0; $j < $n; $j++) {
        $sum += $marks[$j] * $credits[$j];
    }

    $res = array_sum($credits);
    $percentage = $sum / $res;

    $s = 0;
    for ($j = 0; $j < $n; $j++) {
        $s += getPointer($marks[$j]) * $credits[$j];
    }

    $cgpa = $s / $res;

    echo "<h1>Results</h1>";
    echo "Your percentage: " . $percentage . "<br>";
    echo "Your CGPA: " . $cgpa . "<br>";
}
?>
