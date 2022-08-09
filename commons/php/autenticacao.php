<?php
function checkPassword($pdo, $email, $senha)
{
  $sql = <<<SQL
    SELECT password_hash
    FROM anunciante
    WHERE email = ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $senhaHash = $stmt->fetchColumn();

    if (!$senhaHash)
      return false; // email não encontrado

    if (!password_verify($senha, $senhaHash))
      return false; // senha incorreta

    // email e senha corretos
    return $senhaHash;
  } catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

function checkLogged($pdo)
{
  // Verifica se as variáveis de sessão criadas
  // no momento do login estão definidas
  if (!isset($_SESSION['emailUsuario'], $_SESSION['loginString']))
    return false;

  $email = $_SESSION['emailUsuario'];

  // Resgata a senha hash armazenada para conferência
  $sql = <<<SQL
    SELECT password_hash
    FROM anunciante
    WHERE email = ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $senhaHash = $stmt->fetchColumn();
    if (!$senhaHash)
      return false; // nenhum resultado (email não encontrado)

    // Gera uma nova string de login com base nos dados
    // atuais do navegador do usuário e compara com a
    // string de login gerada anteriormente no momento do login
    $loginStringCheck = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
    if (!hash_equals($loginStringCheck, $_SESSION['loginString']))
      return false;

    return true;
  } catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

function exitWhenNotLogged($pdo)
{
  if (!checkLogged($pdo)) {
    http_response_code(401);
    header("Content-Type: application/json");
    echo json_encode("Acesso não autorizado!");
    exit();
  }
}

function getLoggedUserId($pdo)
{
  $sql = <<<SQL
    SELECT codigo
    FROM anunciante
    WHERE email = ?
    SQL;

    $email = $_SESSION['emailUsuario'];

    try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$email]);
      $codigo = $stmt->fetchColumn();
      
      if (!$codigo)
        return null;
  
    } catch (Exception $e) {
      return null;
    }
    return $codigo;
}
