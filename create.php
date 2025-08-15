<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $preco = floatval($_POST['preco']);
    $quantidade = intval($_POST['quantidade']);
    $categoria_id = intval($_POST['categoria_id']);

    if ($nome && $preco > 0 && $quantidade >= 0) {
        $stmt = $conn->prepare("INSERT INTO produtos (nome, preco, quantidade, categoria_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdii", $nome, $preco, $quantidade, $categoria_id);
        if ($stmt->execute()) {
            header("Location: read.php");
            exit;
        } else {
            echo "Erro ao inserir.";
        }
    } else {
        echo "Dados inválidos.";
    }
}
?>
<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    Preço: <input type="number" step="0.01" name="preco" required><br>
    Quantidade: <input type="number" name="quantidade" required><br>
    Categoria:
    <select name="categoria_id">
        <?php
        $categorias = $conn->query("SELECT * FROM categorias");
        while ($c = $categorias->fetch_assoc()) {
            echo "<option value='{$c['id']}'>{$c['nome']}</option>";
        }
        ?>
    </select><br>
    <button type="submit">Cadastrar</button>
</form>
