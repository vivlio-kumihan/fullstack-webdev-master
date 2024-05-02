<!-- 配列として送る。 -->

<!-- GETで配列送る。 -->

<form action="receive.php" method="GET">
  <div><input type="text" name="members[]"></div>
  <div><input type="text" name="members[]"></div>
  <div><input type="text" name="members[]"></div>
  <button type="submit">送信する</button>
</form> 


<!-- POSTで配列を送る。 -->
<form action="receive.php" method="POST">
  <div><input type="text" name="members[]"></div>
  <div><input type="text" name="members[]"></div>
  <div><input type="text" name="members[]"></div>
  <button type="submit">送信する</button>
</form>


<!-- POSTで配列を送る。 -->
<!-- で、こちらでは引数はそのまま入れている。混乱するな。 -->
<form action="receive.php" method="POST">
  <div><input type="text" name="members[id]"></div>
  <div><input type="text" name="members[name]"></div>
  <div><input type="text" name="members[age]"></div>
  <button type="submit">送信する</button>
</form>