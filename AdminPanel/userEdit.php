<?php
$servername = "127.0.0.1";
$username = "root";
$password = "AlexiaTs";
$database = "djanam";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_GET['id'])) {
    try {
        $delete_id = $_GET['id'];
        
        $sql_user_role = "DELETE FROM user_role WHERE UserID = ?";
        $connection->prepare($sql_user_role)->execute([$delete_id]);
        
        $sql_user = "DELETE FROM user WHERE ID = ?";
        $connection->prepare($sql_user)->execute([$delete_id]);
    } catch(PDOException $e) {
        echo "Error deleting record: " . $e->getMessage();
    }
}

try {
    $PDOstatement = $connection->prepare('SELECT * FROM user');
    $PDOstatement->execute();
    $result = $PDOstatement->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error fetching records: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../Images/DjanamLogo.jfif">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap">
    <link rel="stylesheet" href="userEditStyle.css">
    <title>Редактиране на потребители | Djanam Sky Club</title>
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="../IndexPage/index.php">
            <img src="../Images/DjanamLogo2.svg" alt="Djanam Logo">
            Djanam Sky Club
        </a>
        <form class="d-flex" action="../AdminPanel/adminPage.php">
            <button class="btn btn-outline-light" type="submit">Назад</button>
        </form>
    </div>
</nav> 
<section class="hero">

<div class="container mt-5">
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-striped mx-auto text-center">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $row): ?>
                        <tr>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><a href="userEdit.php?id=<?php echo $row['ID']; ?>" class="buttondel">Delete</a></td>
                            <td><a href="roleEdit.php?id=<?php echo $row['ID']; ?>" class="buttonedit">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
