<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack("title")
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/style.css') }}">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>


@yield("content")

@stack("script")

<script>
    class electricity {
  constructor(selector) {
    this.svg = document.querySelector(selector);
    this.run();
  }

  render() {
    let d = this.calculatePoints(0, 0, 500, 80);
    this.svg.querySelectorAll('path')[0].setAttribute('d', d);
    this.svg.querySelectorAll('path')[1].setAttribute('d', d);
  }

  calculatePoints(x, y, width, height) {
    let points = [[x, height / 2]];
    let maxPoints = 10;
    let chunkRange = width / maxPoints;
    for (let i = 0; i < maxPoints; i++) {
      let cx = chunkRange * i + Math.cos(i) * chunkRange;
      let cy = Math.random() * height;
      points.push([cx, cy]);
    }

    points.push([width, height / 2]);

    let d = points.map(point => point.join(','));
    return 'M' + d.join(',');
  }

  run() {
    let fps = 25,
    now,
    delta,
    then = Date.now(),
    interval = 1000 / fps,
    iteration = 0,
    loop = () => {
      requestAnimationFrame(loop);

      now = Date.now();
      delta = now - then;
      if (delta > interval) {
        then = now - delta % interval;

        // update stuff
        this.render(iteration++);
      }
    };
    loop();
  }}




new electricity('svg');
</script>

</body>
</html>