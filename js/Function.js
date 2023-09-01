function closeFunction(){
    document.getElementById("alert").style.display = "none";
}

document.getElementById('olho1').addEventListener('mousedown', function() {
    document.getElementById('password1').type = 'text';
  });
  
  document.getElementById('olho1').addEventListener('mouseup', function() {
    document.getElementById('password1').type = 'password';
  });
  
  // Para que o password não fique exposto apos mover a imagem.
  document.getElementById('olho1').addEventListener('mousemove', function() {
    document.getElementById('password1').type = 'password';
  });

  document.getElementById('olho').addEventListener('mousedown', function() {
    document.getElementById('password').type = 'text';
  });
  
  document.getElementById('olho').addEventListener('mouseup', function() {
    document.getElementById('password').type = 'password';
  });
    
  document.getElementById('olho').addEventListener('mousemove', function() {
    document.getElementById('password').type = 'password';
  });