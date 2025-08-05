<?php
// display_case.php
require 'db_connect.php';

try {
    $stmt = $pdo->query("SELECT * FROM cases ORDER BY start_date DESC");
    $cases = $stmt->fetchAll();
} catch (PDOException $e) {
    http_response_code(500);
    echo "Error fetching cases: " . htmlspecialchars($e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cases List</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet" />
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Cases List</h1>
        <table class="min-w-full border border-gray-300 rounded overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Case ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Client ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Lawyer ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Case Type</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Start Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">End Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($cases) === 0): ?>
                <tr>
                    <td class="border border-gray-300 px-4 py-2 text-center" colspan="8">No cases found.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($cases as $case): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($case['case_id']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($case['client_id']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($case['lawyer_id']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($case['case_type']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= nl2br(htmlspecialchars($case['case_description'])) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($case['case_status']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($case['start_date']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($case['end_date'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>