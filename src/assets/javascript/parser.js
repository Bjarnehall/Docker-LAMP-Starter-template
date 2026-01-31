
function parseMarkdown (textContent) {
    let listOfContent = [];
    let buffer = [];

    for (let i = 0; i < textContent.length; i++) {
        if (textContent[i] !== "\n") {
            buffer.push(textContent[i]);
        } else {
            listOfContent.push(buffer);
            buffer = [];
        }
    }

    let parsedContent = "";

    for (let i = 0; i < listOfContent.length; i++) {
        if (listOfContent[i][0] === "#" &&
            listOfContent[i][1] === "#" &&
            listOfContent[i][2] === "#" &&
            listOfContent[i][3] === "#" &&
            listOfContent[i][4] === "#" &&
            listOfContent[i][5] === "#") {
            parsedContent += `<h6>${listOfContent[i].slice(6).join("")}</h6>`;   
        } else if (listOfContent[i][0] === "#" &&
            listOfContent[i][1] === "#" &&
            listOfContent[i][2] === "#" &&
            listOfContent[i][3] === "#" &&
            listOfContent[i][4] === "#") {
            parsedContent += `<h5>${listOfContent[i].slice(5).join("")}</h5>`;
        } else if (listOfContent[i][0] === "#" &&
            listOfContent[i][1] === "#" &&
            listOfContent[i][2] === "#" &&
            listOfContent[i][3] === "#") {
            parsedContent += `<h4>${listOfContent[i].slice(4).join("")}</h4>`;
        } else if (listOfContent[i][0] === "#" &&
            listOfContent[i][1] === "#" &&
            listOfContent[i][2] === "#") {
            parsedContent += `<h3>${listOfContent[i].slice(3).join("")}</h3>`;
        } else if (listOfContent[i][0] === "#" &&
            listOfContent[i][1] === "#") {
            parsedContent += `<h2>${listOfContent[i].slice(2).join("")}</h2>`;
        } else if (listOfContent[i][0] === "#") {
            parsedContent += `<h1>${listOfContent[i].slice(1).join("")}</h1>`;
        } else {
            parsedContent += `<p>${listOfContent[i].join("")}</h1>`;
        }
    }
    return parsedContent;
}