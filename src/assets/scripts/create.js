// 送信された情報から三つの配列を作成して、DBに送る

// 問題文、選択肢、正解,正解の番号、問題の番号、補足を獲得する

// questionsテーブルに追加する
// 内容：content, image, supplement
//注意点：全て文字列として送る

// choicesテーブルに三つの入れるを追加する
// 内容：id, problem_id, name, valid
// 問題点：id(index)は自動更新されるのか
//注意点：validはboolean型で送る？ validのみ値で送る。それ以外は文字として送る

const questionInput = document.querySelector(
  'input[placeholder="問題文を入力してください"]'
);
const choice_1_Input = document.querySelector(
  'input[placeholder="選択肢1を入力してください"]'
);
const choice_2_Input = document.querySelector(
  'input[placeholder="選択肢2を入力してください"]'
);
const choice_3_Input = document.querySelector(
  'input[placeholder="選択肢3を入力してください"]'
);
const answerInput = document.querySelector(
  'input[placeholder="正解の番号を入力してください"]'
);
const addInfoInput = document.querySelector(
  'input[placeholder="補足を入力してください"]'
);
const submitBtn = document.getElementById("submit");

submitBtn.addEventListener("click", (e) => {
  // e.preventDefault(); // フォーム送信を止める。リロードを防ぐ
  //   console.log(questionInput.value);
  //     console.log(choice_1_Input.value);
  //     console.log(choice_2_Input.value);
  //     console.log(choice_3_Input.value);
  // ラジオボタンで選択された値を取得
  const checkedRadio = document.querySelector('input[name="choice"]:checked');
  let first_option = 0;
  let second_option = 0;
  let third_option = 0;

  if (checkedRadio) {
    if (checkedRadio.value === "option1") {
      first_option = 1;
    } else if (checkedRadio.value === "option2") {
      second_option = 1;
    } else if (checkedRadio.value === "option3") {
      third_option = 1;
    }
    //   console.log(first_option, second_option, third_option);
  } else {
    console.log("正解が選択されていません");
  }
  const fileInput = document.querySelector('input[type="file"]');
  const file = fileInput.files[0];
  if (file) {
    console.log(file.name);
  } else {
    console.log("No file selected");
  }
  //   console.log(addInfoInput.value);

  //   ここまでが確認用。
  //   この先配列に入れて、DBに送る
  let questionArray = [];
  let choicesArray_1 = [];
  let choicesArray_2 = [];
  let choicesArray_3 = [];

  questionArray.push(questionInput.value);
  questionArray.push(file ? file.name : ""); // ファイル名を追加。ファイルが選択されていない場合は空文字を追加
  questionArray.push(addInfoInput.value);

  choicesArray_1.push(choice_1_Input.value);
  choicesArray_1.push(first_option);

  choicesArray_2.push(choice_2_Input.value);
  choicesArray_2.push(second_option);

  choicesArray_3.push(choice_3_Input.value);
  choicesArray_3.push(third_option);

  console.log(questionArray);
  console.log(choicesArray_1);
  console.log(choicesArray_2);
  console.log(choicesArray_3);

  // ここでDBに送る
  let problem_id = Date.now(); // 仮の問題ID。実際にはサーバー側で生成されることが多い

  choicesArray_1.push(problem_id); // PHP側でセットする場合は不要
  choicesArray_2.push(problem_id);
  choicesArray_3.push(problem_id);

  // let myArray = {
  //     questions: questionArray,
  //     choices: [
  //         choicesArray_1,
  //         choicesArray_2,
  //         choicesArray_3
  //     ]
  // };

  // const mysql = require("../.././/../docker/mysql/init.sql");
  // const connection = mysql.createConnection({
  //   host: "localhost",
  //   user: "root", // MySQLのユーザー名
  //   password: "root", // MySQLのパスワード
  //   database: "posse", // 使用するデータベース名
  // });

  // questionArray.forEach((item) => {
  //   const query = "INSERT INTO questions (content, image, supplement) ";

  //   connection.query(
  //     query,
  //     [item.content, item.image, item.supplement],
  //     (err, results) => {
  //       if (err) {
  //         console.error("挿入エラー: " + err.stack);
  //         return;
  //       }
  //       console.log("データ挿入成功: ", results);
  //     }
  //   );
  // });

  // const myArray = {
  //   questions: questionArray,
  //   choices: [
  //     choicesArray_1,
  //     choicesArray_2,
  //     choicesArray_3
  //   ]
  // };

  // fetch('/admin/questions/create.php', {
  //   method: 'POST',
  //   headers: {
  //     'Content-Type': 'application/json'
  //   },
  //   body: JSON.stringify(myArray)
  // })
  // .then(response => response.text())
  // .then(data => {
  //   console.log("サーバーからの応答:", data);
  // })
  // .catch(error => {
  //   console.error("エラーが発生しました:", error);
  // });

    fetch('/admin/questions/create.php', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    questions: questionArray,
    choices: [
      choicesArray_1,
      choicesArray_2,
      choicesArray_3
    ]})
});

  // 送信後、配列を空にする
  questionArray = [];
  choicesArray_1 = [];
  choicesArray_2 = [];
  choicesArray_3 = [];

  // フォームの内容をリセットする
  questionInput.value = "";
  choice_1_Input.value = "";
  choice_2_Input.value = "";
  choice_3_Input.value = "";
  const radioButtons = document.querySelectorAll('input[name="choice"]');
  radioButtons.forEach((radio) => {
    radio.checked = false;
  });
  fileInput.value = "";
  addInfoInput.value = "";

});


