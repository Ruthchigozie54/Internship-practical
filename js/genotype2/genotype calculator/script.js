function checkCompatibility(){

    const genotype1 = document.getElementById("genotype1").value;

    const genotype2 = document.getElementById("genotype2").value;

    const result = document.getElementById("result");

    if(genotype1 === "" || genotype2 === ""){
      result.innerHTML = "Please select both genotype";
    }

    else if(
      (genotype1 === "AA" && genotype2 === "AA") ||
      (genotype1 === "AA" && genotype2 === "AS") ||
      (genotype1 === "AS" && genotype2 === "AA") ||
      (genotype1 === "AC" && genotype2 === "AA") ||
      (genotype1 === "AA" && genotype2 === "AC")
    ){
      result.innerHTML = "Compatible, please go and marry";
    }

    else if(
      (genotype1 === "AS" && genotype2 === "AS") ||
      (genotype1 === "AS" && genotype2 === "SS") 
    ){
      result.innerHTML = "The Compatibility is Very Risky"
    }

    else if(
      (genotype1 === "SS" && genotype2 === "SS")
    ){
      result.innerHTML = "This is not Compatible at all"
    }

    else{
      result.innerHTML = "Seek Medical Advice from your Doctor"
    }


}