$(() => {

    $('.select2').select2()
    
    var getUrlHost = window.location.origin
    var urlSegment = window.location.pathname.split('/')

    let siswa = $('#data-siswa').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-siswa',
        columns:[
            {data:'id_siswa',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nisn',name:'nisn'},
            {data:'nama_siswa',name:'nama_siswa'},
            {data:'kelas',name:'kelas'},
            {data:'tahun_ajaran',name:'tahun_ajaran'},
            {data:'username',name:'username'},
            {data:'status_user',name:'status_user'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    siswa.on( 'order.dt search.dt',() => {
        siswa.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let guru = $('#data-guru').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-guru',
        columns:[
            {data:'id_guru',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nip',name:'nip'},
            {data:'nama_guru',name:'nama_guru'},
            {data:'username',name:'username'},
            {data:'status_user',name:'status_user'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    guru.on( 'order.dt search.dt',() => {
        guru.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let pembimbing = $('#data-pembimbing').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-pembimbing',
        columns:[
            {data:'id_pembimbing_pkl',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nip_pembimbing',name:'nip_pembimbing'},
            {data:'nama_instansi',name:'nama_instansi'},
            {data:'nama_pembimbing',name:'nama_pembimbing'},
            {data:'jabatan',name:'jabatan'},
            {data:'username',name:'username'},
            {data:'status_user',name:'status_user'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    pembimbing.on( 'order.dt search.dt',() => {
        pembimbing.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let monitoring = $('#data-monitoring').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-monitoring',
        columns:[
            {data:'id_monitoring',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nisn',name:'nisn'},
            {data:'nama_siswa',name:'nama_siswa'},
            {data:'kelas',name:'kelas'},
            {data:'tahun_ajaran',name:'tahun_ajaran'},
            {data:'nama_instansi',name:'nama_instansi'},
            {data:'nama_guru',name:'nama_guru'},
            {data:'nama_pembimbing',name:'nama_pembimbing'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    monitoring.on( 'order.dt search.dt',() => {
        monitoring.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let id_monitoring = $('#data-monitoring-detail').attr('id-monitoring')
    let monitoring_detail = $('#data-monitoring-detail').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-monitoring-detail/'+id_monitoring,
        columns:[
            {data:'id_monitoring_detail',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'tanggal_absen',name:'tanggal_absen'},
            {data:'kegiatan',name:'kegiatan'},
            {data:'status_verified',name:'status_verified'},
            {data:'waktu_verified',name:'waktu_verified'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    monitoring_detail.on( 'order.dt search.dt',() => {
        monitoring_detail.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let id_siswa = $('#data-monitoring-siswa').attr('id-siswa')
    let monitoring_siswa = $('#data-monitoring-siswa').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-monitoring-siswa/'+id_siswa,
        columns:[
            {data:'id_monitoring_detail',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nisn',name:'nisn'},
            {data:'nama_siswa',name:'nama_siswa'},
            {data:'tanggal_absen',name:'tanggal_absen'},
            {data:'kegiatan',name:'kegiatan'},
            {data:'status_verified',name:'status_verified'},
            {data:'waktu_verified',name:'waktu_verified'}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    monitoring_siswa.on( 'order.dt search.dt',() => {
        monitoring_siswa.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let id_guru = $('#data-monitoring-guru').attr('id-guru')
    let monitoring_guru = $('#data-monitoring-guru').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-monitoring-guru/'+id_guru,
        columns:[
            {data:'id_monitoring',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nisn',name:'nisn'},
            {data:'nama_siswa',name:'nama_siswa'},
            {data:'kelas',name:'kelas'},
            {data:'tahun_ajaran',name:'tahun_ajaran'},
            {data:'nama_instansi',name:'nama_instansi'},
            {data:'nama_guru',name:'nama_guru'},
            {data:'nama_pembimbing',name:'nama_pembimbing'}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    monitoring_guru.on( 'order.dt search.dt',() => {
        monitoring_guru.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let id_pembimbing = $('#data-monitoring-pembimbing').attr('id-pembimbing')
    let monitoring_pembimbing = $('#data-monitoring-pembimbing').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-monitoring-pembimbing/'+id_pembimbing,
        columns:[
            {data:'id_monitoring',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nisn',name:'nisn'},
            {data:'nama_siswa',name:'nama_siswa'},
            {data:'kelas',name:'kelas'},
            {data:'tahun_ajaran',name:'tahun_ajaran'},
            {data:'nama_instansi',name:'nama_instansi'},
            {data:'nama_guru',name:'nama_guru'},
            {data:'nama_pembimbing',name:'nama_pembimbing'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    monitoring_pembimbing.on( 'order.dt search.dt',() => {
        monitoring_pembimbing.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let menu_makan = $('#menu-makan').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/menu-makan',
        columns:[
            {data:'id_menu_makan',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_menu',name:'nama_menu'},
            {data:'harga_menu',name:'harga_menu'},
            {data:'foto_menu',name:'foto_menu'},
            {data:'status_menu',name:'status_menu'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    menu_makan.on( 'order.dt search.dt',() => {
        menu_makan.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
        	cell.innerHTML = i+1;
        })
    }).draw()

    let jenis_barang = $('#data-jenis-barang').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-jenis-barang',
        columns:[
            {data:'id_jenis_barang',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_jenis',name:'nama_jenis'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    jenis_barang.on( 'order.dt search.dt',() => {
        jenis_barang.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let barang = $('#data-barang').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang',
        columns:[
            {data:'id_barang',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_barang',name:'nama_barang'},
            {data:'nama_jenis',name:'nama_jenis'},
            {data:'stok_barang',name:'stok_barang'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    barang.on( 'order.dt search.dt',() => {
        barang.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let supplier = $('#data-supplier').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-supplier',
        columns:[
            {data:'id_supplier',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_supplier',name:'nama_supplier'},
            {data:'nomor_telepon_supplier',name:'nomor_telepon_supplier'},
            {data:'alamat_supplier',name:'alamat_supplier'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    supplier.on( 'order.dt search.dt',() => {
        supplier.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let barang_masuk = $('#data-barang-masuk').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang-masuk',
        columns:[
            {data:'id_barang_masuk',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'tanggal_masuk',name:'tanggal_masuk'},
            {data:'nama_supplier',name:'nama_supplier'},
            {data:'keterangan',name:'keterangan'},
            {data:'name',name:'name'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 1, 'asc' ]],
        responsive:true,
        fixedColumns: true
    })
    barang_masuk.on( 'order.dt search.dt',() => {
        barang_masuk.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let barang_masuk_detail = $('#data-barang-masuk-detail').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang-masuk/detail/'+urlSegment[4],
        columns:[
            {data:'id_barang_masuk_detail',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_jenis',name:'nama_jenis'},
            {data:'nama_barang',name:'nama_barang'},
            {data:'jumlah_masuk',name:'jumlah_masuk'},
            {data:'harga_satuan',name:'harga_satuan'},
            {data:'harga_total',name:'harga_total'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    barang_masuk_detail.on( 'order.dt search.dt',() => {
        barang_masuk_detail.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let barang_keluar = $('#data-barang-keluar').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-barang-keluar',
        columns:[
            {data:'id_barang_keluar',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'tanggal_barang_keluar',name:'tanggal_barang_keluar'},
            {data:'keterangan',name:'keterangan'},
            {data:'name',name:'name'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 1, 'asc' ]],
        responsive:true,
        fixedColumns: true
    })
    barang_keluar.on( 'order.dt search.dt',() => {
        barang_keluar.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let transaksi = $('#transaksi').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-transaksi',
        columns:[
            {data:'id_transaksi',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'tanggal_transaksi',name:'tanggal_transaksi'},
            {data:'total_harga',name:'total_harga'},
            {data:'total_bayar',name:'total_bayar'},
            {data:'name',name:'name'},
            {data:'keterangan',name:'keterangan'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 1, 'asc' ]],
        responsive:true,
        fixedColumns: true
    })
    transaksi.on( 'order.dt search.dt',() => {
        transaksi.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let transaksi_detail = $('#transaksi-detail').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-transaksi/detail/'+urlSegment[4],
        columns:[
            {data:'id_transaksi_detail',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'nama_menu',name:'nama_menu'},
            {data:'banyak_pesan',name:'banyak_pesan'},
            {data:'sub_total',name:'sub_total'},
            {data:'keterangan',name:'keterangan'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    transaksi_detail.on( 'order.dt search.dt',() => {
        transaksi_detail.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    let users = $('#data-users').DataTable({
        processing:true,
        serverSide:true,
        ajax:getUrlHost+'/datatables/data-users',
        columns:[
            {data:'id_users',searchable:false,render:(data,type,row,meta) => {
                return meta.row + meta.settings._iDisplayStart+1;
            }},
            {data:'name',name:'name'},
            {data:'username',name:'username'},
            {data:'status_akun',name:'status_akun'},
            {data:'action',name:'action',searchable:false,orderable:false}
        ],
        scrollCollapse: true,
        columnDefs: [ {
        sortable: true,
        "class": "index",
        }],
        scrollX:true,
        order: [[ 0, 'desc' ]],
        responsive:true,
        fixedColumns: true
    })
    users.on( 'order.dt search.dt',() => {
        users.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
            cell.innerHTML = i+1;
        })
    }).draw()

    var numInput = 1

    $('#tambah-input').click(() => {
        numInput++
        $('#hapus-input').removeClass('hide-btn')

        $('.row').find('.select2').select2().select2('destroy')

        $('#input-barang').clone().appendTo($('#append')).attr('div-input',numInput)

        let divInput = $(`#input-barang[div-input="${numInput}"]`)

        divInput.find('select,input').attr('num-input',numInput)
        divInput.find('input').val('')

        $('.row').find('.select2').select2()
    })

    $(document).on('change','.jenis-barang',(el) => {
        let val    = $(el.target).val()
        let getNum = $(el.target).attr('num-input')

        $.ajax({
            url: getUrlHost+'/ajax/data-barang/'+val
        })
        .done((done) => {
            let barangSelect = $(`.barang[num-input="${getNum}"]`)

            barangSelect.removeAttr('disabled')
            
            barangSelect.find('option').not(':first').remove()

            $.each(done, (index,element) => {
                let barangOption = `<option value="${element.id_barang}" stock-type="${element.satuan_stok}">
                                        ${element.nama_barang}
                                    </option>`

                barangSelect.append(barangOption)
            })
        })
        .fail((fail) => {
            console.log(fail)
        })

    })

    $(document).on('change','.barang',(el) => {
        let getNum      = $(el.target).attr('num-input')
        let getStokType = $(el.target).children('option:selected').attr('stock-type')

        $(`.satuan-stok[num-input="${getNum}"]`).val(getStokType)
    })

    $(document).on('keyup','.jumlah-masuk',(el) => {
        let getNum         = $(el.target).attr('num-input')
        let getVal         = $(el.target).val()
        let getHargaSatuan = $(`.harga-satuan[num-input="${getNum}"]`).val()

        if (getHargaSatuan != 0 || getHargaSatuan != null) {
            let hargaTotal = getVal * getHargaSatuan

            $(`.harga-total[num-input="${getNum}"]`).val(hargaTotal)
        }
    })

    $(document).on('keyup','.harga-satuan',(el) => {
        let getNum         = $(el.target).attr('num-input')
        let getVal         = $(el.target).val()
        let getJumlahMasuk = $(`.jumlah-masuk[num-input="${getNum}"]`).val()

        if (getJumlahMasuk != 0 || getJumlahMasuk != null) {
            let hargaTotal = getVal * getJumlahMasuk

            $(`.harga-total[num-input="${getNum}"]`).val(hargaTotal)
        }
    })

})
