<?php
// スラッシュ + アスタリスク二つでエンター
// DOC COMMENT
/**
 * 税率計算の関数を記述するためのファイル
 * 
 * @author quad9
 * @since 0.0.0
 */

// リファレンスは
// https://zonuexe.github.io/phpDocumentor2-ja/references/phpdoc/index.html

/**
 * title: 
 * 税込み金額を取得する関数
 * 
 * 詳しい説明はこちら。
 * 
 * @param int $base_price 価格
 * @param float $tax_rate 税率
 * 
 * @return int 税込み金額
 * 戻り値を返さない場合は
 * @return void
 * 
 * 参考資料がある場合
 * @see https://example.com/
 */

function with_tax($base_price, $tax_rate = 0.1) {
    $sum_price = $base_price + ($base_price * $tax_rate);
    $sum_price = round($sum_price);
    return $sum_price;
}
