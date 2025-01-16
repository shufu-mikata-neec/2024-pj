<?php

// SESSIONを開始
session_start();
// SESSIONを破棄
session_destroy();

echo 'ログアウトしました';
echo '<a href="/">TOPへ</a>';
