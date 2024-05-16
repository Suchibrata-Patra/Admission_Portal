
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $package = $_POST["package"];
            $dateOfJourney = isset($_POST["dateOfJourney"]) ? $_POST["dateOfJourney"] : '';
            $returnDate = isset($_POST["returnDate"]) ? $_POST["returnDate"] : '';
            $numberOfPersons = $_POST["numberOfPersons"];
    ?>
           <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title mb-4">Confirmation</h5>
                    <div class="mb-3">
                        <span class="fw-bold">Name:</span> <?php echo $name; ?>
                    </div>
                    <div class="mb-3">
                        <span class="fw-bold">Email:</span> <?php echo $email; ?>
                    </div>
                    <div class="mb-3">
                        <span class="fw-bold">Package:</span> <?php echo $package; ?>
                    </div>
                    <?php if ($package === 'package1'): ?>
                        <div class="mb-3">
                            <span class="fw-bold">Date of Journey:</span> <?php echo $dateOfJourney; ?>
                        </div>
                    <?php else: ?>
                        <div class="mb-3">
                            <span class="fw-bold">Date of Journey:</span> <?php echo $dateOfJourney; ?>
                        </div>
                        <div class="mb-3">
                            <span class="fw-bold">Return Date:</span> <?php echo $returnDate; ?>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <span class="fw-bold">Number of Persons:</span> <?php echo $numberOfPersons; ?>
                    </div>
                    <form action="send.php" method="post">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <button type="submit" class="btn btn-primary">Send Hello Message</button>
                    </form>
                </div>
            </div>

    <?php
        }
    ?>

    <!-- Bootstrap JS (optional, for certain features like dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
