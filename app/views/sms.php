<style>
    .otp-container {
  max-width: 400px;
  margin: auto;
  padding: 30px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  text-align: center;
  font-family: Arial, sans-serif;
}

.otp-inputs {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin: 20px 0;
}

.otp-inputs input {
  width: 40px;
  height: 50px;
  font-size: 24px;
  text-align: center;
  border: 2px solid #ccc;
  border-radius: 8px;
  outline: none;
}

.otp-inputs input:focus {
  border-color: #2e8b57;
  box-shadow: 0 0 5px #2e8b57;
}

button {
  padding: 10px 20px;
  background-color: #2e8b57;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

button:disabled {
  background-color: #aaa;
  cursor: not-allowed;
}

</style>

<form action="/valide/tokken" method="POST">
    <div class="otp-container">
      <h2>🔐 Vérification OTP</h2>
      <p>Entrez le code reçu :</p>
      <div class="otp-inputs">
        <input type="text" maxlength="1" name="number[]" />
        <input type="text" maxlength="1" disabled  name="number[]"/>
        <input type="text" maxlength="1" disabled  name="number[]" />
        <input type="text" maxlength="1" disabled name="number[]" />
        <input type="text" maxlength="1" disabled name="number[]" />
        <input type="text" maxlength="1" disabled  name="number[]"/>
      </div>
      <input type="email" name="email" value="<?= $_GET['m'] ?>" hidden>
      <button id="confirmBtn" disabled>✅ Confirmer</button>
    </div>
</form>



<script>
  const inputs = document.querySelectorAll(".otp-inputs input");
const confirmBtn = document.getElementById("confirmBtn");

inputs.forEach((input, index) => {
  input.addEventListener("input", () => {
    if (input.value.length === 1 && index < inputs.length - 1) {
      inputs[index + 1].disabled = false;
      inputs[index + 1].focus();
    }

    const allFilled = Array.from(inputs).every(inp => inp.value.length === 1);
    confirmBtn.disabled = !allFilled;
  });

  input.addEventListener("keydown", (e) => {
    if (e.key === "Backspace" && input.value === "" && index > 0) {
      inputs[index - 1].focus();
    }
  });
});

confirmBtn.addEventListener("click", () => {
  const otp = Array.from(inputs).map(inp => inp.value).join("");
  alert("✅ OTP vérifié : " + otp);
});

// setTimeout(()=>{
 
// },3000)

</script>