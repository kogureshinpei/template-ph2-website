// $(document).on('click', '.delete-btn', function(e) {
//   e.preventDefault();
//   const id = $(this).data('id');
//   if (confirm('本当に削除しますか？')) {
//     $.ajax({
//       url: 'index.php',
//       type: 'POST',
//       data: { delete_id: id },
//       success: function(response) {
//         alert(response);
//         location.reload(); // ページをリロードして一覧を更新
//       },
//       error: function(xhr, status, error) {
//         alert('削除に失敗しました');
//       }
//     });
//   }
// });
console.log("delete.jsが読み込まれました");
document.addEventListener('DOMContentLoaded', () => {
  const deleteButtons = document.querySelectorAll('.delete-btn');
  
  deleteButtons.forEach(button => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!confirm(`ID:${id} の質問を削除しますか？`)) return;

      try {
        const res = await fetch('../../admin/delete_data.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          body: `id=${encodeURIComponent(id)}`
        });
        const data = await res.json();

        if (data.success) {
          alert('削除しました');
          // ページをリロード or 対応する要素を削除
          location.reload();
        } else {
          alert('削除に失敗しました');
        }
      } catch (err) {
        console.error('エラー内容', err);
        alert(`通信エラーが発生しました: ${err.message}`);  // 詳細メッセージ表示
      }
    });
  });
});