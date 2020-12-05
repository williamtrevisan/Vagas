    <main>
        <h2 class="mt-3">Excluir vaga</h2>
        <form method="post">
            <div class="form-group">
               <p>Você deseja realmente excluir a vaga <strong><?= $obVaga->titulo ?></strong>?</p>
            </div>
            <div class="form-group">
                <button type="submit" name="excluir" class="btn btn-success">Excluir</button>
                <a href="index.php">
                    <button type="button" class="btn btn-danger">
                        Cancelar
                    </button>
                </a>
            </div>
        </form>
    </main>