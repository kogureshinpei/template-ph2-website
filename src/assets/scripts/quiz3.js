"use strict";
{
  /**
   * @typedef QUIZ
   * @property {number} correctNumber 問題番号
   * @property {string | undefined} note ノート
   * @property {string} question 問題文
   * @property {string[]} answers 回答の配列
   */

  /**
   * @description 問題と回答の定数
   * @type {QUIZ[]}
   */
  // const ALL_QUIZ = [
  //   {
  //     id: 1,
  //     question: '日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？',
  //     answers: ['約28万人', '約79万人', '約183万人'],
  //     correctNumber: 1,
  //     note: '経済産業省 2019年3月 － IT 人材需給に関する調査'
  //   },
  //   {
  //     id: 2,
  //     question: '既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？',
  //     answers: ['INTECH', 'BIZZTECH', 'X-TECH'],
  //     correctNumber: 2,
  //   },
  //   {
  //     id: 3,
  //     question: 'IoTとは何の略でしょう？',
  //     answers: ['Internet of Things', 'Integrate into Technology', 'Information on Tool'],
  //     correctNumber: 0,
  //   },
  //   {
  //     id: 4,
  //     question: 'イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？',
  //     answers: ['Society 5.0', 'CyPhy', 'SDGs'],
  //     correctNumber: 0,
  //     note: 'Society5.0 - 科学技術政策 - 内閣府'
  //   },
  //   {
  //     id: 5,
  //     question: 'イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？',
  //     answers: ['Web3.0', 'NFT', 'メタバース'],
  //     correctNumber: 0,
  //   },
  //   {
  //     id: 6,
  //     question: '先進テクノロジー活用企業と出遅れた企業の収益性の差はどれくらいあると言われているでしょうか？',
  //     answers: ['約2倍', '約5倍', '約11倍'],
  //     correctNumber: 1,
  //     note: 'Accenture Technology Vision 2021'
  //   }
  // ];

  /**
   * @description クイズコンテナーの取得
   * @type {HTMLElement}
   */
  // const quizContainer = document.getElementById('js-quizContainer');

  /**
   * @description クイズ１つ１つのHTMLを生成するための関数
   * @param quizItem { QUIZ }
   * @param questionNumber { number }
   * @returns {string}
   */
  const createQuizHtml = (quizItem, questionNumber) => {
    /**
     * @description 回答の生成
     * @type {string}
     */
    const answersHtml = quizItem.answers
      .map(
        (answer, answerIndex) =>
          `<li class="p-quiz-box__answer__item">
        <button class="p-quiz-box__answer__button js-answer"
          data-answer="${answerIndex}"
          data-valid="${quizItem.correctNumber === answerIndex ? 1 : 0}"
          data-name="${answer}">
          ${answer}<i class="u-icon__arrow"></i>
        </button>
      </li>`
      )
      .join("");

    // 引用テキストの生成
    const noteHtml = quizItem.note
      ? `<cite class="p-quiz-box__note">
      <i class="u-icon__note"></i>${quizItem.note}
    </cite>`
      : "";

    return `<section class="p-quiz-box js-quiz" data-quiz="${questionNumber}">
      <div class="p-quiz-box__question">
        <h2 class="p-quiz-box__question__title">
          <span class="p-quiz-box__label">Q${questionNumber + 1}</span>
          <span
            class="p-quiz-box__question__title__text">${
              quizItem.question
            }</span>
        </h2>
        <figure class="p-quiz-box__question__image">
          <img src="../assets/img/quiz/img-quiz0${quizItem.id}.png" alt="">
        </figure>
      </div>
      <div class="p-quiz-box__answer">
        <span class="p-quiz-box__label p-quiz-box__label--accent">A</span>
        <ul class="p-quiz-box__answer__list">
          ${answersHtml}
        </ul>
        <div class="p-quiz-box__answer__correct js-answerBox">
          <p class="p-quiz-box__answer__correct__title js-answerTitle"></p>
          <p class="p-quiz-box__answer__correct__content">
            <span class="p-quiz-box__answer__correct__content__label">A</span>
            <span class="js-answerText"></span>
          </p>
        </div>
      </div>
      ${noteHtml}
    </section>`;
  };

  /**
   * @description 配列の並び替え
   * @param arrays {Array}
   * @returns {Array}
   */
  // const shuffle = arrays => {
  //   const array = arrays.slice();
  //   for (let i = array.length - 1; i >= 0; i--) {
  //     const randomIndex = Math.floor(Math.random() * (i + 1));
  //     [array[i], array[randomIndex]] = [array[randomIndex], array[i]];
  //   }
  //   return array
  // }

  /**
   * @description quizArrayに並び替えたクイズを格納
   * @type {Array}
   */
  // const quizArray = shuffle(ALL_QUIZ)

  /**
   * @type {string}
   * @description 生成したクイズのHTMLを #js-quizContainer に挿入
   */
  const quizContainer = () =>
    (document.getElementById("js-quizContainer").innerHTML = quizArray
      .map((quizItem, index) => {
        return createQuizHtml(quizItem, index);
      })
      .join(""));

  // =================================

  /**
   * @type {NodeListOf<Element>}
   * @description すべての問題を取得
   */
  const allQuiz = document.querySelectorAll(".js-quiz");

  /**
   * @description buttonタグにdisabledを付与
   * @param answers {NodeListOf<Element>}
   */
  // const setDisabled = answers => {
  //   answers.forEach(answer => {
  //     answer.disabled = true;
  //   })
  // }

  /**
   * @description trueかfalseで出力する文字列を出し分ける
   * @param target {Element}
   * @param isCorrect {boolean}
   */
  // const setTitle = (target, isCorrect) => {
  //   target.innerText = isCorrect ? '正解！' : '不正解...';
  // }

  /**
   * @description trueかfalseでクラス名を付け分ける
   * @param target {Element}
   * @param isCorrect {boolean}
   */
  // const setClassName = (target, isCorrect) => {
  //   console.log({ quiz, answerBox });
  //   target.classList.add(isCorrect ? 'is-correct' : 'is-incorrect');
}

const allQuiz = document.querySelectorAll(".js-quiz");
/**
 * 各問題の中での処理
 */
allQuiz.forEach((quiz) => {
  // クイズのデータを取得
  const ALL_QUIZ = [
    {
      id: 1,
      question:
        "日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？",
      answers: ["約28万人", "約79万人", "約183万人"],
      correctNumber: 1,
      note: "経済産業省 2019年3月 － IT 人材需給に関する調査",
    },
    {
      id: 2,
      question:
        "既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？",
      answers: ["INTECH", "BIZZTECH", "X-TECH"],
      correctNumber: 2,
    },
    {
      id: 3,
      question: "IoTとは何の略でしょう？",
      answers: [
        "Internet of Things",
        "Integrate into Technology",
        "Information on Tool",
      ],
      correctNumber: 0,
    },
    {
      id: 4,
      question:
        "イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？",
      answers: ["Society 5.0", "CyPhy", "SDGs"],
      correctNumber: 0,
      note: "Society5.0 - 科学技術政策 - 内閣府",
    },
    {
      id: 5,
      question:
        "イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？",
      answers: ["Web3.0", "NFT", "メタバース"],
      correctNumber: 0,
    },
    {
      id: 6,
      question:
        "先進テクノロジー活用企業と出遅れた企業の収益性の差はどれくらいあると言われているでしょうか？",
      answers: ["約2倍", "約5倍", "約11倍"],
      correctNumber: 1,
      note: "Accenture Technology Vision 2021",
    },
  ];
  // 各問題の要素を取得
  const answers = quiz.querySelectorAll(".js-answer");
  const selectedQuiz = Number(quiz.getAttribute("data-quiz"));
  // const answerBox = quiz.querySelector('.js-answerBox');
  const answerTitle = quiz.querySelector(".js-answerTitle");
  //   const setTitle = (target, isCorrect) => {
  //   target.innerText = isCorrect ? '正解！' : '不正解...';
  // }
  // const answerText = quiz.querySelector('.js-answerText');
  //   ーーーーーーーーーーーーーーーーーーーーーーーー~−181行目から4行分下に移動させた(引数のtargetをquizに変更)
  const setClassName = (target, isCorrect) => {
    // console.log({ quiz, answerBox });
    target.classList.add(isCorrect ? "is-correct" : "is-incorrect");
  };

  answers.forEach((answer) => {
    answer.addEventListener("click", () => {
      // 同じ問題内のボタンだけ取得
      const parentQuizBox = answer.closest(".p-quiz-box__answer__item");
      const localAnswers = parentQuizBox.querySelectorAll(".js-answer");
      localAnswers.forEach((btn) => (btn.disabled = true));
      answer.classList.add("is-selected");
      // 押されたボタンが属するsection（.p-quiz-box）を取得
      const parentSection = answer.closest(".p-quiz-box");
      // そのsection内の全てのbuttonにdisabledを付与
      const sectionAnswers = parentSection.querySelectorAll(".js-answer");
      sectionAnswers.forEach((btn) => (btn.disabled = true));

      // answer.classList.add('is-selected');
      // ==============
      // これ以下は正誤判定の処理
      // =======================
      // const answerText = document.querySelector('.p-quiz-box__answer__correct.js-result .js-answerText');
      // const selectedAnswerNumber = Number(answer.getAttribute('data-answer'));
      // const correctNumber = ALL_QUIZ[selectedQuiz].correctNumber;
      // const isCorrect = correctNumber === selectedAnswerNumber;
      // answerText.innerHTML = ALL_QUIZ[selectedQuiz].answers[ALL_QUIZ[selectedQuiz].correctNumber];
      // setTitle(answerTitle, isCorrect);
      // setClassName(answerBox, isCorrect);
      // answerText.style.display = 'block';

      // const a = document.querySelector('.p-quiz-box__answer__item');
      // const select_but = a.querySelector('[data-valid]');
      const select_any = answer.getAttribute("data-valid");
      // console.log(select_but);
      // console.log(select_any);
      // const select_valid = select_but.dateset.valid;
      // console.log(select_valid);
      let correctText = "";
      sectionAnswers.forEach((btn) => {
        if (btn.getAttribute("data-valid") === "1") {
          correctText = btn.getAttribute("data-name");
        }
      });
      const answerBox = parentSection.querySelector(
        ".p-quiz-box__answer__correct"
      );
      const correct_content = answerBox.querySelector(
        ".p-quiz-box__answer__correct__content"
      );
      // correct_content.textContent = answer.getAttribute('data-name');
      correct_content.textContent = correctText;
      if (select_any === "1") {
        // console.log('正解');
        answerTitle.textContent = "正解！";
        // console.log(answerTitle);
        answerBox.style.display = "block";
        answerBox.appendChild(answerTitle);
        answerBox.classList.add("is-correct");
        // console.log(correct_content);
      } else {
        // console.log('不正解');
        answerTitle.textContent = "不正解...正しい答えは↑";
        // console.log(answerTitle);
        answerBox.style.display = "block";
        answerBox.appendChild(answerTitle);
        answerBox.classList.add("is-incorrect");
        // console.log(correct_content);
      }
      // =======================
    });
  });
});

// 正誤判定・表示処理はそのまま
// const selectedAnswerNumber = Number(answer.getAttribute('data-answer'));
//       const correctNumber = quizArray[selectedQuiz].correctNumber;
//       const isCorrect = correctNumber === selectedAnswerNumber;
//       const answerText = () => quiz.querySelector('.js-answerText').innerHTML = quizArray[selectedQuiz].answers[correctNumber];
//       setTitle(answerTitle, isCorrect);
//       setClassName(answerBox, isCorrect);

// ーーーーーーーーーーーーーーーーーーーーー
("use strict");
{
  // クイズデータ（DB連携の場合はPHPでwindow.ALL_QUIZ = ... で渡す）
  const ALL_QUIZ = [
    {
      id: 1,
      question:
        "日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？",
      answers: ["約28万人", "約79万人", "約183万人"],
      correctNumber: 1,
      note: "経済産業省 2019年3月 － IT 人材需給に関する調査",
    },
    {
      id: 2,
      question:
        "既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？",
      answers: ["INTECH", "BIZZTECH", "X-TECH"],
      correctNumber: 2,
    },
    {
      id: 3,
      question: "IoTとは何の略でしょう？",
      answers: [
        "Internet of Things",
        "Integrate into Technology",
        "Information on Tool",
      ],
      correctNumber: 0,
    },
    {
      id: 4,
      question:
        "サイバー空間とフィジカル空間を高度に融合させたシステムにより、経済発展と社会的課題の解決を両立する、人間中心の社会のことをなんと言うでしょう？",
      answers: ["Society5.0", "CyPhy", "SDGs"],
      correctNumber: 0,
      note: "Society5.0 - 科学技術政策 - 内閣府",
    },
    {
      id: 5,
      question:
        "イギリスのコンピューター科学者であるギャビン・ウッド氏が提唱した、ブロックチェーン技術を活用した「次世代分散型インターネット」のことをなんと言うでしょう？",
      answers: ["Web3.0", "NFT", "メタバース"],
      correctNumber: 0,
    },
    {
      id: 6,
      question:
        "先進テクノロジー活用企業と出遅れた企業の収益性の差はどれくらいあると言われているでしょうか？",
      answers: ["約2倍", "約5倍", "約11倍"],
      correctNumber: 1,
      note: "Accenture Technology Vision 2021",
    },
  ];

  let current = 0;
  let correctCount = 0;
  const quizContainer = document.getElementById("js-quizContainer");

  function showQuiz() {
    if (current >= ALL_QUIZ.length) {
      quizContainer.innerHTML = `
        <div class="p-quiz-box__answer__correct is-correct">
          <p class="p-quiz-box__answer__correct__title">全問終了！</p>
          <p class="p-quiz-box__answer__correct__content">正解数：${correctCount} / ${ALL_QUIZ.length}</p>
        </div>
      `;
      return;
    }
    const q = ALL_QUIZ[current];
    quizContainer.innerHTML = `
      <section class="p-quiz-box js-quiz" data-quiz="${current}">
        <div class="p-quiz-box__question">
          <h2 class="p-quiz-box__question__title">
            <span class="p-quiz-box__label">Q${current + 1}</span>
            <span class="p-quiz-box__question__title__text">${q.question}</span>
          </h2>
          <img src="../assets/img/quiz/img-quiz0${q.id}.png" alt="">
        </div>
        <div class="p-quiz-box__answer">
          <span class="p-quiz-box__label p-quiz-box__label--accent">A</span>
          <ul class="p-quiz-box__answer__list">
            ${q.answers
              .map(
                (a, i) => `
              <li class="p-quiz-box__answer__item">
                <button class="p-quiz-box__answer__button js-answer" data-index="${i}">${a}<i class="u-icon__arrow"></i></button>
              </li>
            `
              )
              .join("")}
          </ul>
          <div class="p-quiz-box__answer__correct js-result" style="display:none;">
            <span class="js-answerTitle"></span>
            <span class="js-answerText"></span>
            <button class="p-quiz-next-btn" style="margin-top:16px;">次の問題へ</button>
          </div>
        </div>
        ${
          q.note
            ? `<cite class="p-quiz-box__note"><i class="u-icon__note"></i>${q.note}</cite>`
            : ""
        }
      </section>
    `;
  }
}
