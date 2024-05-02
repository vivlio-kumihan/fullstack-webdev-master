<!-- ブラウザには見えない入力欄を設けて、適宜サーバーに値を送るためのinput要素。 -->
<!-- ただし、簡単に改竄が可能。計算するとかそういうものには使えない。 -->
<!-- 。。。なんだかなぁ。。。であるが、道のり長いので頑張る。 -->
<form action="post.php" method="POST">
  <div>
    <label for="amount">個数</label>
    <input id="amount" type="number" name="amount">
  </div>
  <div>
    <label for="price">価格</label>
    <input id="price" type="number" name="price">
  </div>
  <div>
    割引: 10%
  </div>
  <!-- type="hidden"に値を与えてサーバーに送ることができる。 -->
  <input type="hidden" name="discount" value="10">
  <button type="submit">送信</button>
</form>