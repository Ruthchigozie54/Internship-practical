const wordInput = document.getElementById("word");
const shuffleBtn = document.getElementById("shuffleBtn");
const result = document.getElementById("result");

shuffleBtn.addEventListener("click", shuffleWord);

async function shuffleWord() {
  const word = wordInput.value;

  if (word.trim() === "") {
    alert("Please enter a word.");
    return;
  }
  result.innerHTML = "<p>Loading...</p>";
  try {
    const response = await fetch(
      `api/shuffle.php?word=${encodeURIComponent(word)}`,
    );
    const data = await response.json();

    if (!data.success) {
      result.innerHTML = `<h3>${data.message}</h3>`;
      return;
    }

    displayResult(data);
  } catch (error) {
    result.innerHTML = "<h3>Something went wrong.</h3>";
    console.log(error);
  }
}

function displayResult(data) {
  let frequencyHTML = "";

  for (const letter in data.frequency) {
    frequencyHTML += `
            <li>${letter} : ${data.frequency[letter]}</li>
        `;
  }

  let shuffleHTML = "";
  data.shuffles.forEach((shuffle, index) => {
    shuffleHTML += `
            <li>${index + 1}. ${shuffle}</li>
        `;
  });
  result.innerHTML = `
    <div class="card">
        <h2>Result</h2>

        <hr><br>

        <p><strong>Word:</strong> ${data.word}</p>
        <p><strong>Length:</strong> ${data.length}</p>
        <p><strong>Possible Rearrangements:</strong> ${data.possible_rearrangements}</p>
        <p><strong>Formula:</strong> ${data.formula} = ${data.possible_rearrangements}</p>

        <br>

        <h3>Letter Frequency</h3>
        <ul>
            ${frequencyHTML}
        </ul>

        <br>

        <h3>Random Shuffles</h3>
        <ol>
            ${shuffleHTML}
        </ol>
   </div>

    `;
}
