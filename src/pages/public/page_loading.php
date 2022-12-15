<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --fundoVerde: hsl(122, 100%, 97%);
    }

    body {
      width: 100vw;
      height: 100vh;
      background-color: var(--fundoVerde);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .line {
      display: inline-block;
      width: 15px;
      height: 15px;
      border-radius: 15px;
      background-image: linear-gradient(225deg,
          rgb(254, 157, 102),
          rgb(232, 113, 58),
          rgb(241, 73, 22));
    }

    .load-1 .line:nth-last-child(1) {
      animation: loadingA 1.5s 1s infinite;
    }

    .load-1 .line:nth-last-child(2) {
      animation: loadingA 1.5s 0.5s infinite;
    }

    .load-1 .line:nth-last-child(3) {
      animation: loadingA 1.5s 0s infinite;
    }

    @keyframes loadingA {
      0% {
        height: 15px;
      }

      50% {
        height: 35px;
      }

      100% {
        height: 15px;
      }
    }
  </style>
</head>

<body>
  <div class="load-wrapp">
    <div class="load-1">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </div>
  </div>
</body>

</html>