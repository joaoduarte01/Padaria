<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: read.php");
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM produtos WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$produto = $stmt->get_result()->fetch_assoc();

if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $preco = floatval($_POST['preco']);
    $quantidade = intval($_POST['quantidade']);
    $categoria_id = intval($_POST['categoria_id']);

    $stmt = $conn->prepare("UPDATE produtos SET nome=?, preco=?, quantidade=?, categoria_id=? WHERE id=?");
    $stmt->bind_param("sdiii", $nome, $preco, $quantidade, $categoria_id, $id);
    if ($stmt->execute()) {
        header("Location: read.php");
        exit;
    } else {
        echo "Erro ao atualizar.";
    }
}
?>
<form method="POST">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required><br>
    Preço: <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required><br>
    Quantidade: <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" required><br>
    Categoria:
    <select name="categoria_id">
        <?php
        $categorias = $conn->query("SELECT * FROM categorias");
        while ($c = $categorias->fetch_assoc()) {
            $selected = ($c['id'] == $produto['categoria_id']) ? "selected" : "";
            echo "<option value='{$c['id']}' $selected>{$c['nome']}</option>";
        }
        ?>
    </select><br>
    <button type="submit">Salvar</button>
</form>
