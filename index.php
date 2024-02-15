<?php
$pagetitle = 'انتقاء';
ob_start();
session_start();
include 'init.php'; ?>
<!--<div class="landing_page" style="background-image: url('images/background.jpeg');opacity: 1;">-->
<div class="landing_page" style="background-color:white;">

    <div style="text-align: center;font-size:25px;color:#fff; margin-top:120px;font-weight:bold" class="">
        <img src="images/main_logo.png" style="width: 240px; height: auto;" alt="">
    </div>
    <div class="home_section">
        <div class="container">
            <div class="header">
            <h3 style="color: #2b2b2b; text-align:center"> الشريك الأفضل لنجاح المبيعات </h3>
            </div>
            <div class="data" style="margin-top: 5%;">
                <a href="company/index">
                    <div class="section2 main_section animate__animated animate__backInRight ">
                        <div class="section_data">
                            <button class="hover" id="danger" style="background-color:var(--main-color);;border-radius:6px;border:none;font-size:19px;color:#ffff;padding:50px">
                                <p>
                                    للشركات

                                </p>
                                <p>
                                    For Companies
                                </p>
                            </button>
                        </div>
                    </div>
                </a>
                <a href="ind/index">
                    <div class="section1 main_section animate__animated animate__backInLeft ">
                        <div class="section_data p-6">
                            <button class="hover" id="danger" style="background-color:var(--main-color);;border-radius:6px;border:none;font-size:19px;color:#ffff;padding:50px">
                                <p>
                                    للأفراد
                                </p>
                                <p>
                                    For Individuals
                                </p>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php
    ?>