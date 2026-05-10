const sidebar = document.querySelector('aside.sidebar');
const scroll = document.querySelector('::-webkit-scrollbar');

// Rotate animation caret sub menu
function rotate(elm) {
    let down = elm.getElementsByClassName('drop-icon-item')[0];
    down.classList.toggle('down');
}

// Slide animation sidebar
function slide() {
    let sidebar = document.getElementsByClassName('sidebar')[0];
    let overlay = document.getElementById('overlay');
    overlay.classList.toggle('bg-overlay');
    sidebar.classList.toggle('slide');
}

// Show & Hide password
function showPassword(btn) {
    let input = btn.parentElement.getElementsByClassName('input-show-password')[0];

    if (input.type === "password") {
        btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"><path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/><path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/> </svg>';
        input.type = "text";
    } else {
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" /><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" /></svg>`;
        input.type = "password";
    }
}

function collapseMaster() {
    let elm = document.getElementById('collapse-btn');
    let item = elm.getElementsByClassName('drop-icon-item')[0];
    let dataMaster = elm.classList.contains('data-master');
    let menuMaster = document.getElementsByClassName('collapse-master');

    if (dataMaster == true) {
        item.classList.toggle('down');
        for (let i = 0; i < menuMaster.length; i++) {
            menuMaster[i].classList.add('show');
        }
    }
}

// Ubah tanggal dari database menjadi format indonesia
function tgl_indo(tanggal) {
    let data = tanggal;
    let tgl = data.split('-');
    let tahun = tgl[0];
    let bulan = tgl[1];
    let hari = tgl[2];

    switch (bulan) {
        case '01':
            bulan = 'Januari';
            break;
        case '02':
            bulan = 'Februari';
            break;
        case '03':
            bulan = 'Maret';
            break;
        case '04':
            bulan = 'April';
            break;
        case '05':
            bulan = 'Mei';
            break;
        case '06':
            bulan = 'Juni';
            break;
        case '07':
            bulan = 'Juli';
            break;
        case '08':
            bulan = 'Agustus';
            break;
        case '09':
            bulan = 'September';
            break;
        case '10':
            bulan = 'Oktober';
            break;
        case '11':
            bulan = 'November';
            break;
        default:
            bulan = 'Desember';
            break;
    }

    return hari + ' ' + bulan + ' ' + tahun;
};

document.addEventListener('DOMContentLoaded', function () {
    collapseMaster();
});

// When mouse enters
sidebar.addEventListener('mouseenter', () => {
    changeScrollDisplay('block');
});

// When mouse leaves
sidebar.addEventListener('mouseleave', () => {
    changeScrollDisplay('none');
});

function changeScrollDisplay(display) {
    const style = document.createElement('style');
    style.innerHTML = `
    ::-webkit-scrollbar {
      display: ${display};
    }`;
    document.head.appendChild(style);
}



