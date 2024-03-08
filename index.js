let container = document.getElementById('container')
const notifikasi = $('.info-data').data('infodata');


		if (notifikasi == "Login Berhasil" || notifikasi == "Register Berhasil") {
			Swal.fire({
				icon: 'success',
				title: 'Sukses',
				text: notifikasi,
			})
		}
toggle = () => {
	container.classList.toggle('sign-in')
	container.classList.toggle('sign-up')
}

setTimeout(() => {
	container.classList.add('sign-in')
}, 200)