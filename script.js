$(document).ready(function() {
    // 訪問済みの都道府県をpinkに塗りつぶす
    for (const prefecture in visitedPrefectures) {
      if (visitedPrefectures[prefecture]) {
        $("#japan-map").find(`*[id="${prefecture}"]`).attr("fill", "pink"); 
      }
    }
  
    // 編集ボタンクリック時の処理
    $(".editBtn").click(function() {
      const rowNumber = $(this).data("row");
      alert(`編集: ${rowNumber}行目を編集`); 
      // TODO: 編集フォームを表示する処理を追加
    });
  
    // 削除ボタンクリック時の処理
    $(".deleteBtn").click(function() {
      const rowNumber = $(this).data("row");
      if (confirm(`削除: ${rowNumber}行目を削除しますか？`)) { 
        // TODO: CSVからデータを削除し、表を更新する処理を追加
      }
    });
  });