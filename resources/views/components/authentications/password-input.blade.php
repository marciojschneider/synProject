<div class="mb-3 form-password-toggle">
  {{-- <div class="d-flex justify-content-between">
    <label class="form-label" for="password">{{ $label }}</label>
    @if ($forgot)
      <a href="{{ route('forgot-password') }}">
        <small>Esqueceu sua senha?</small>
      </a>
    @endif
  </div> --}}
  <div class="input-group input-group-merge">
    <input type="password" id="{{ $id }}" class="form-control @error($name) is-invalid @enderror"
      name="{{ $name }}" aria-describedby="password" />
    <span class="input-group-text cursor-pointer" onclick="togglePassword('{{ $id }}')"><i
        id="{{ $id }}-icon" class="bx bx-show"></i></span>
  </div>
  @error($name)
    <div id="defaultFormControlHelp" class="form-text">{{ $message }}</div>
  @enderror
</div>

<script>
  if (typeof togglePassword !== 'function') {
    function togglePassword(inputId) {
      const input = document.getElementById(inputId)
      const icon = document.getElementById(inputId + '-icon')

      if (input.type === 'password') {
        input.type = 'text'
        icon.classList.replace('bx-show', 'bx-hide')
      } else {
        input.type = 'password'
        icon.classList.replace('bx-hide', 'bx-show')
      }
    }
  }
</script>
