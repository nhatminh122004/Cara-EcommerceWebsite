<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara - Your Ecommerce App</title>
    <link rel="shortcut icon" href="./assets/icon.png" type="image/.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/responsiveHome.css">
    <style>
        /* Original styles for the features section */
        #feature {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        #feature .fe-box {
            width: 180px;
            text-align: center;
            padding: 25px 15px;
            box-shadow: 20px 20px 34px rgba(0, 0, 0, 0.03);
            border: 1px solid #cce7d0;
            border-radius: 4px;
            margin: 15px 0;
            cursor: pointer;
        }

        #feature .fe-box:hover {
            box-shadow: 10px 10px 54px rgba(70, 62, 221, 0.1);
        }

        #feature .fe-box img {
            width: 100%;
            margin-bottom: 10px;
        }

        #feature .fe-box h6 {
            display: inline-block;
            padding: 9px 8px 6px 8px;
            line-height: 1;
            border-radius: 4px;
            color: #088178;
            background-color: #fddde4;
        }

        #feature .fe-box:nth-child(2) h6 {
            background-color: #cdebbc;
        }

        #feature .fe-box:nth-child(3) h6 {
            background-color: #d1e8f2;
        }

        #feature .fe-box:nth-child(4) h6 {
            background-color: #f6dbf6;
        }

        #feature .fe-box:nth-child(5) h6 {
            background-color: #cdd4f8;
        }

        #feature .fe-box:nth-child(6) h6 {
            background-color: #fff2e5;
        }

        .section-p1 {
            padding: 40px 80px;
        }

        .section-title {
            text-align: center;
            width: 100%;
            margin-bottom: 20px;
        }

        .section-title h2 {
            margin: 0;
            font-size: 2em;
        }

        .section-title p {
            margin: 0;
            font-size: 1.2em;
            color: #555;
        }

        /* New styles for the categories section */
        #categories {
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        #categories .fe-box {
            width: 200px;
            text-align: center;
            padding: 25px 15px;
            box-shadow: 20px 20px 34px rgba(0, 0, 0, 0.03);
            border: 1px solid #cce7d0;
            border-radius: 10px;
            margin: 20px 10px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        #categories .fe-box:hover {
            box-shadow: 10px 10px 54px rgba(70, 62, 221, 0.1);
            transform: scale(1.05);
        }

        #categories .fe-box img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        #categories .fe-box h6 {
            display: inline-block;
            padding: 9px 8px 6px 8px;
            line-height: 1;
            border-radius: 4px;
            color: #088178;
            background-color: #fddde4;
        }

        #categories .fe-box:nth-child(2) h6 {
            background-color: #cdebbc;
        }

        #categories .fe-box:nth-child(3) h6 {
            background-color: #d1e8f2;
        }

        #categories .fe-box:nth-child(4) h6 {
            background-color: #f6dbf6;
        }

        #categories .fe-box:nth-child(5) h6 {
            background-color: #cdd4f8;
        }

        #categories .fe-box:nth-child(6) h6 {
            background-color: #fff2e5;
        }
        .pro a {
            text-decoration: none;
            color: black;
        }
        .pro a:hover {
            color: #333;
            text-decoration: none;
        }
    </style>
   
</head>