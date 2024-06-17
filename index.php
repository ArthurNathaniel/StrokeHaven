<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <div class="header">
        <p><span><i class="fa-solid fa-thumbtack"></i></span></p>
    </div>
    <div class="role_all">
        <div class="title">
            <h2>What type of account are you setting up?</h2>
        </div>
        <div class="role_grid">
            <div class="role_box">
                <a href="register.php?role=patient">
                    <img src="./images/patient.png" alt="">
                    <p class="role">Patient</p>
                    <p>Create your personal account for seamless healthcare management.</p>
                </a>
            </div>
            <!-- <div class="role_box">
            <a href="register.php?role=caregiver">
                <img src="./images/caregiver.png" alt="">

               <p class="role">Caregiver</p>
                <p>Register to support and manage your loved one's health journey.</p>
                </a>
            </div> -->
            <div class="role_box">
            <a href="register.php?role=healthcare_provider">
                <img src="./images/doctor.png" alt="">

            <p class="role">Healthcare Provider</p>
                <p>Sign up to offer your medical expertise and care to patients</p>
                </a>
            </div>
        </div>
        <div class="btns_index">
        <a href="login.php">
            <button>Login</button>
        </a>
        </div>
    </div>
</body>

</html>