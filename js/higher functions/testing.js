//forEach function: forEach()
//forEach() is used to loop through an array.
//It performs an action on every item in the array.

// const numbers = [1, 2, 3, 4];

// numbers.forEach(function(alpa) {
//     console.log(alpa);
// });



//map function [map()

//map() is used to:
//✅ Loop through an array
//✅ Modify each item
//✅ Return a NEW array

//The original array stays unchanged.]
//EXAMPLE

// const numbers = [1, 2, 3, 4, 5, 6]

// const doubled = numbers.map(function(num) {
//   return num * 2;
// })
// console.log("this is the new array ", doubled);


// const names = ["john", "mary", "david"]

// const upper = names.map(function(name) {
//   return name.toUpperCase();
// });

// console.log(upper);



//filter function [filter()

//filter() is used to:

//✅ Check each item
//✅ Keep only items that pass a condition
//✅ Return a NEW array (UNDER A SPECIFIC CONDITION)]

//EXAMPLE
// const numbers = [1, 2, 3, 4, 5, 6];

// const evenNumber = numbers.filter(function(num) {
//   return num % 2 === 0;
// })
// console.log(evenNumber);


// const ages = [12, 18, 25, 15, 30];

// const adult = ages.filter(function(age) {
//   return age >= 18;
// })

// console.log("you're an adult ",adult);


//reduce function [The word reduce means: “Take many values and reduce them into ONE value.”
//reduce() is used to:
//✅ Reduce all array values into ONE value

//Examples:
//Sum of numbers
//Total price
//Average
//Product multiplication]

//For instance
// array.reduce(function(accumulator, currentValue) {
//     return accumulator + currentValue;
// }, initialValue);

//EXPLANATION:
// | Term         | Meaning                   |
// | ------------ | ------------------------- |

// | accumulator  | Stores the running result |

// | currentValue | Current item in the array |

// | initialValue | Starting value            |


// const numbers = [1, 2, 3, 4, 5];

// const total = numbers.reduce(function(acc, num) {
//   return acc + num;
// }, 0);
// console.log(total);

//  OR

// const price = [100, 200, 300];

// const totalPrice = price.reduce(function(total, price) {
//   return total + price;
// }, 0);
// console.log(totalPrice);


//finding average using REDUCE FUNCTION
// const scores = [80, 90, 100];

// const total = scores.reduce(function(acc, score) {
//   return acc + score;
// }, 0);

// const average = total / scores.length;

// console.log(average);

//finding largest number using REDUCE FUNCTION


const numbers = [4, 9, 2, 15, 7];
const largest = numbers.reduce(function(acc, num) {
    if (num > acc) {
        return num;
    } else {
        return acc;
    }
}, numbers[0]);

console.log(largest);


// MODERN SHORTER SYNTAX
//INSTEAD OF THIS:
// numbers.map(function(num) {
//   return num * 2;
//});

//USE THIS:
// numbers.map(num => num * 2); (they both mean the same thing.)


// Complete Example Using All Four
// const numbers = [1, 2, 3, 4, 5];

// // forEach
// numbers.forEach(num => {
//     console.log(num);
// });

// // map
// const doubled = numbers.map(num => num * 2);
// console.log(doubled);

// // filter
// const even = numbers.filter(num => num % 2 === 0);
// console.log(even);

// // reduce
// const total = numbers.reduce((acc, num) => acc + num, 0);
// console.log(total);