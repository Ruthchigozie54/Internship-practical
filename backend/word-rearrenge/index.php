<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Word Shuffle Generator</title>
  <link rel="stylesheet" href="css/style.css">
  </head>

<body>

  <div class="container">

    <h1>Word Shuffle Generator</h1>

    <p class="subtitle">
      Enter any word and discover how many unique ways it can be rearranged.
    </p>

    <div class="card">

      <label for="word">
        Enter a Word
      </label>

      <input
        type="text"
        id="word"
        placeholder="Example: APPLE">

      <button id="shuffleBtn">
        Shuffle Word
      </button>

    </div>

    <div id="result">

    </div>

  </div>

  <script src="js/app.js"></script>

</body>

</html>