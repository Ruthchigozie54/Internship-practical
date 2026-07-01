function checkCompatibility(){

    const genotype1 = document.getElementById("genotype1").value;

    const genotype2 = document.getElementById("genotype2").value;

    const result = document.getElementById("result");


    if(genotype1 === "" || genotype2 === ""){
        result.innerHTML = "Please select both genotypes";
        result.style.color = "red";
        return;
    }


    const combination = genotype1 + "-" + genotype2;


    const compatible = [
        "AA-AA",
        "AA-AS",
        "AS-AA",
        "AA-AC",
        "AC-AA"
    ];


    const risky = [
        "AS-AS",
        "AS-AC",
        "AC-AS",
        "AC-AC"
    ];


    const notCompatible = [
        "SS-SS",
        "AS-SS",
        "SS-AS",
        "AC-SS",
        "SS-AC"
    ];


    if(compatible.includes(combination)){
        result.innerHTML = "Compatible 😊, please go and marry";
        result.style.color = "green";
    }

    else if(risky.includes(combination)){
        result.innerHTML = "Very Risky Compatibility ⚠️";
        result.style.color = "orange";
    }

    else if(notCompatible.includes(combination)){
        result.innerHTML = "Not Compatible At All ❌";
        result.style.color = "red";
    }

    else{
        result.innerHTML = "Seek Medical Advice from your Doctor";
        result.style.color = "blue";
    }

}