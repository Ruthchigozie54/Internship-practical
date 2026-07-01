document.getElementById("addRow").addEventListener("click", function () {

    let tbody = document.querySelector("#dataTable tbody");

    let row = `
        <tr>

            <td>
                <input type="number" class="x" step="any">
            </td>

            <td>
                <input type="number" class="f">
            </td>

            <td class="d">-</td>

            <td class="d<sup>2</sup>">-</td>

            <td class="fd<sup>2</sup>">-</td>

            <td>
                <button class="deleteBtn">Delete</button>
            </td>

        </tr>
    `;

    tbody.insertAdjacentHTML("beforeend", row);

});


document.querySelector("#dataTable tbody").addEventListener("click", function (e) {

    if (e.target.classList.contains("deleteBtn")) {

        let rows = document.querySelectorAll("#dataTable tbody tr");

        if (rows.length > 1) {

            e.target.closest("tr").remove();

        } else {

            alert("At least one row must remain.");

        }

    }

});


document.getElementById("calculate").addEventListener("click", function () {

    let mean = parseFloat(document.getElementById("mean").value);

    if (isNaN(mean)) {

        alert("Please enter the mean.");

        return;

    }

    let rows = document.querySelectorAll("#dataTable tbody tr");

    let data = [];

    rows.forEach(function (row) {

        let x = parseFloat(row.querySelector(".x").value);

        let f = parseFloat(row.querySelector(".f").value);

        if (!isNaN(x) && !isNaN(f)) {

            data.push({

                x: x,
                f: f

            });

        }

    });

    if (data.length === 0) {

        alert("Please enter at least one row.");

        return;

    }

    fetch("api.php", {

        method: "POST",

        headers: {

            "Content-Type": "application/json"

        },

        body: JSON.stringify({

            mean: mean,
            rows: data

        })

    })

    .then(response => response.json())

    .then(result => {

        let tableRows = document.querySelectorAll("#dataTable tbody tr");

        result.rows.forEach(function (item, index) {

            tableRows[index].querySelector(".d").textContent = item.d;

            tableRows[index].querySelector(".d2").textContent = item.d2;

            tableRows[index].querySelector(".fd2").textContent = item.fd2;

        });

        document.getElementById("totalF").textContent = result.totalF;

        document.getElementById("totalFD2").textContent = result.totalFD2;

        document.getElementById("stdDev").textContent = result.standardDeviation;

    })

    .catch(function () {

        alert("Error connecting to API.");

    });

});


document.getElementById("reset").addEventListener("click", function () {

    document.getElementById("mean").value = "";

    let tbody = document.querySelector("#dataTable tbody");

    tbody.innerHTML = `
        <tr>

            <td>
                <input type="number" class="x" step="any">
            </td>

            <td>
                <input type="number" class="f">
            </td>

            <td class="d">-</td>

            <td class="d2">-</td>

            <td class="fd2">-</td>

            <td>
                <button class="deleteBtn">Delete</button>
            </td>

        </tr>
    `;

    document.getElementById("totalF").textContent = "0";

    document.getElementById("totalFD2").textContent = "0";

    document.getElementById("stdDev").textContent = "0";

});