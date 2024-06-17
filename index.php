<?php

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザープロファイル生成</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        form label, form input, form select, form button {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>ユーザープロファイル生成</h1>
    <form action="download.php" method="post">
        <label for="employeeCount">従業員数:</label>
        <input type="number" id="employeeCount" name="employeeCount" min="1" max="100" value="5">

        <label for="minSalary">最低給与:</label>
        <input type="number" id="minSalary" name="minSalary" min="0" step="1000" value="30000">

        <label for="maxSalary">最高給与:</label>
        <input type="number" id="maxSalary" name="maxSalary" min="0" step="1000" value="30000">

        <label for="locationNumberRange">ロケーション数:</label>
        <input type="number" id="locationNumberRange" name="locationNumberRange" min="0" step="10" value="5">

        <label for="zipCodeRange">郵便番号範囲:</label>
        <input type="number" id="zipCodeRange" name="zipCodeRange" min="0" step="1000" value="5">

        <label for="format">ダウンロード形式:</label>
        <select id="format" name="format">
            <option value="html">HTML</option>
            <option value="markdown">Markdown</option>
            <option value="json">JSON</option>
            <option value="txt">テキスト</option>
        </select>

        <button type="submit">生成</button>
    </form>
</body>
</html>
