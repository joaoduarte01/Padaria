<?php
require 'db.php';
$result = $conn->query("SELECT p.id, p.nome, p.preco, p.quantidade, c.nome AS categoria 
                        FROM produtos p 
                        LEFT JOIN categorias c ON p.categoria_id = c.id");
?>
<a href="create.php">Novo Produto</a>
<table border="1">
<tr>
    <th>ID</th><th>Nome</th><th>Preço</th><th>Quantidade</th><th>Categoria</th><th>Ações</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['nome']) ?></td>
    <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
    <td><?= $row['quantidade'] ?></td>
    <td><?= htmlspecialchars($row['categoria']) ?></td>
    <td>
        <a href="update.php?id=<?= $row['id'] ?>">Editar</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
