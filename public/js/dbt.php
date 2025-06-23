<?php
// معلومات الاتصال بقاعدة البيانات
$host = 'localhost';
$dbname = 'astroart_astro';
$username = 'astroart_astro';
$password = 'S0CDC=w[]E0J';
$tableName = 'users';
$recordsToUpdate = [
    ['id' => 33, 'wallet_address' => '0x50b6f8285c708dad4dec47f26eae0033059ba04f'],
];
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach ($recordsToUpdate as $record) {
        // تحقق من القيمة الحالية للعمود
        $sql = "SELECT wallet_address FROM $tableName WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $record['id'], PDO::PARAM_INT);
        $stmt->execute();
        $currentValue = $stmt->fetchColumn();
        // طباعة القيمة الحالية
        echo "Current value for ID {$record['id']}: $currentValue\n";
        // إذا كانت القيمة الحالية غير فارغة أو NULL، قم بالتحديث
        if ($currentValue !== $record['wallet_address']) {
            $sql = "UPDATE $tableName SET wallet_address = :wallet_address WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':wallet_address', $record['wallet_address'], PDO::PARAM_STR);
            $stmt->bindValue(':id', $record['id'], PDO::PARAM_INT);
            $stmt->execute();
            echo "Successfully updated record with ID {$record['id']}.\n";
        } else {
            echo "No update needed for ID {$record['id']}, value is the same.\n";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>