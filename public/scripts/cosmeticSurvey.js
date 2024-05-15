const productRecommendations = {
    normal: [
        {
            id: 1,
            name: "Gentle",
            desc: "крем для лица",
        },
        {
            id: 2,
            name: "Silk",
            desc: "минеральная пудра",
        },
    ],
    dry: [
        {
            id: 3,
            name: "Rose",
            desc: "крем для лица",
        },
        {
            id: 4,
            name: "Milk",
            desc: "масло для тела",
        },
    ],
    oily: [
        {
            id: 5,
            name: "Paradise",
            desc: "минеральная пудра",
        },
        {
            id: 6,
            name: "Sun",
            desc: "бомбочка для ванны",
        },
    ],
    combination: [
        {
            id: 7,
            name: "Violet",
            desc: "крем для лица",
        },
        {
            id: 8,
            name: "Clean",
            desc: "маска для лица",
        },
    ],
    sensitive: [
        {
            id: 9,
            name: "Coconut",
            desc: "масло для тела",
        },
        {
            id: 10,
            name: "Lavender",
            desc: "мыло ручной работы",
        },
    ],
    issues: {
        acne: [
            {
                id: 8,
                name: "Clean",
                desc: "маска для лица",
            },
        ],
        pigmentation: [
            {
                id: 11,
                name: "Lotos",
                desc: "маска для лица",
            },
        ],
        wrinkles: [
            {
                id: 1,
                name: "Gentle",
                desc: "крем для лица",
            },
        ],
        sensitivity: [
            {
                id: 7,
                name: "Violet",
                desc: "крем для лица",
            },
        ],
        loss_of_elasticity: [
            {
                id: 3,
                name: "Rose",
                desc: "крем для лица",
            },
        ],
    },
};

function generateProductLink(product) {
    return `<a href="/products/${product.id}">${product.name} - ${product.desc}</a>`;
}

document.getElementById("openModal").onclick = function () {
    document.getElementById("surveyModal").style.display = "flex";
    document.body.style.overflow = "hidden";
};

document.querySelector(".close").onclick = function () {
    document.getElementById("surveyModal").style.display = "none";
    document.body.style.overflow = "auto";
};

window.onclick = function (event) {
    if (event.target === document.getElementById("surveyModal")) {
        document.getElementById("surveyModal").style.display = "none";
        document.body.style.overflow = "auto";
    }
};

function submitSurvey() {
    const skinType = document.getElementById("skinType").value;
    const skinIssues = Array.from(
        document.getElementById("skinIssue").selectedOptions
    ).map((option) => option.value);

    let recommendations = productRecommendations[skinType] || [];

    skinIssues.forEach((issue) => {
        if (productRecommendations.issues[issue]) {
            recommendations = recommendations.concat(
                productRecommendations.issues[issue]
            );
        }
    });

    const recommendationsHtml = `
                <h3>Рекомендуемые продукты для вашего типа кожи:</h3>
                <ul class="d-flex flex-column gap-1">${recommendations
                    .map((item) => `<li>${generateProductLink(item)}</li>`)
                    .join("")}
                </ul>
            `;

    document.getElementById("cosmeticSurvey").style.display = "none";
    const recommendationsElement = document.getElementById("recommendations");
    recommendationsElement.innerHTML = recommendationsHtml;
    recommendationsElement.style.display = "block";

    document.getElementById("resetSurveyButton").style.display = "block";
}

function resetSurvey() {
    document.getElementById("cosmeticSurvey").style.display = "block";
    document.getElementById("recommendations").style.display = "none";
    document.getElementById("recommendations").innerHTML = "";

    document.getElementById("resetSurveyButton").style.display = "none";
}
