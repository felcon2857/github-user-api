// run the program using nodejs runtime environment
// or using a console in a browser

const hamming_distance = (x, y) => {
    //variable to get the distance with value of 0 so the return will not be NaN
    let distance = 0;
    // variable to compare the value of x and y
    let hamming = x ^ y;
    // execute statement for calculating hamming distacnce between two object(integer value)
    // while (hamming > 0){then:execute hamming distance}
    while (hamming) {
        distance++;
        hamming &= hamming - 1;
    }
    // return distance value between the two object(integer)
    return distance;
};
// displaying the result by calling hamming_distance(with x_value-included, y_value-included)
console.log(hamming_distance(1, 4));
