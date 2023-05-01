<?php

class DatabaseFunction
{
    public function selectAllData($db, $role)
    {
        if ($role == 'Guru') {
            $query = $db->prepare(
                "SELECT * FROM tb_guru ORDER BY nip"
            );

        } else if ($role == "Siswa") {
            $query = $db->prepare(
                "SELECT * FROM tb_siswa ORDER BY nis"
            );

        } else if ($role == "Staff") {
            $query = $db->prepare(
                "SELECT * FROM tb_staff ORDER BY nip"
            );

        } else if ($role == "Mapel") {
            $query = $db->prepare(
                "SELECT * FROM tb_mapel"
            );

        } else if ($role == "Kelas") {
            $query = $db->prepare(
                "SELECT * FROM tb_kelas"
            );

        } else if ($role == "KodeKelas") {
            $query = $db->prepare(
                "SELECT * FROM tb_kodekelas"
            );

        } else {
            $query = "";
        }

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectDataUser($db, $role)
    {
        if ($role == 'Guru') {
            $query = $db->prepare(
                "SELECT id, nip, nama FROM tb_guru ORDER BY nip"
            );

        } else if ($role == "Siswa") {
            $query = $db->prepare(
                "SELECT id, nis, nama FROM tb_siswa ORDER BY nis"
            );

        } else {
            $query = "";
        }

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectAllById($db, $role, $id)
    {
        if ($role == "Guru") {
            $query = $db->prepare(
                "SELECT * FROM tb_guru WHERE id = :id"
            );

        } else if ($role == "Siswa") {
            $query = $db->prepare(
                "SELECT * FROM tb_siswa WHERE id = :id"
            );

        } else if ($role == "Staff") {
            $query = $db->prepare(
                "SELECT * FROM tb_staff WHERE id = :id"
            );

        } else if ($role == "Mapel") {
            $query = $db->prepare(
                "SELECT * FROM tb_mapel WHERE id = :id"
            );

        } else if ($role == "KodeKelas") {
            $query = $db->prepare(
                "SELECT * FROM tb_kodekelas WHERE id = :id"
            );

        } else {
            $query = "";
        }

        $query->bindParam(":id", $id);

        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;

    }

    public function selectUserById($db, $role, $id)
    {
        if ($role == "Guru") {
            $query = $db->prepare(
                "SELECT id, nip, nama FROM tb_guru WHERE id = :id ORDER BY nip"
            );

        } else if ($role == "Siswa") {
            $query = $db->prepare(
                "SELECT id, nis, nama FROM tb_siswa WHERE id = :id ORDER BY nis"
            );

        } else {
            $query = "";
        }

        $query->bindParam(":id", $id);

        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;

    }

    public function selectByCode($db, $role, $kode)
    {
        if ($role == "Guru") {
            $query = $db->prepare(
                "SELECT id, nip, nama FROM tb_guru WHERE nip = :kode"
            );

        } else if ($role == "Siswa") {
            $query = $db->prepare(
                "SELECT id, nis, nama FROM tb_siswa WHERE nis = :kode"
            );

        } else if ($role == "Mapel") {
            $query = $db->prepare(
                "SELECT id, kode, mapel FROM tb_mapel WHERE kode = :kode"
            );

        } else if ($role == "KodeKelas") {
            $query = $db->prepare(
                "SELECT id, kode, id_mapel FROM tb_kodekelas WHERE kode = :kode"
            );

        } else {
            $query = "";
        }

        $query->bindParam(":kode", $kode);

        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;

    }

    public function selectUserAll($db)
    {
        $query = $db->prepare(
            "SELECT nip AS 'ni', nama, password, role FROM tb_staff
            UNION
            SELECT nip AS 'ni', nama, password, role FROM tb_guru
            UNION
            SELECT nis AS 'ni', nama, password, role FROM tb_siswa
            ORDER BY ni"
        );

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    public function selectJoinKodeKelas($db)
    {
        $query = $db->prepare(
            "SELECT tb_kodekelas.id, tb_kodekelas.kode AS kode_kelas, tb_mapel.kode AS kode_mapel,tb_mapel.mapel
            FROM tb_kodekelas 
            INNER JOIN tb_mapel ON tb_kodekelas.id_mapel = tb_mapel.id
            ORDER BY kode_kelas"
        );

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function selectJoinJadwal($db)
    {
        $query = $db->prepare(
            "SELECT tb_jadwal.id_kodekelas AS id, tb_kodekelas.kode AS kode_kelas, tb_mapel.mapel, tb_guru.nip, tb_guru.nama AS nama_guru,tb_jadwal.hari, tb_jadwal.jam
            FROM tb_jadwal
            INNER JOIN tb_kodekelas ON tb_jadwal.id_kodekelas = tb_kodekelas.id
            INNER JOIN tb_guru ON tb_jadwal.id_guru = tb_guru.id
            INNER JOIN tb_mapel ON tb_kodekelas.id_mapel = tb_mapel.id
            ORDER BY kode_kelas"
        );

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function selectJoinJadwalUnique($db)
    {
        $query = $db->prepare(
            "SELECT tb_jadwal.id_kodekelas AS id, tb_kodekelas.kode AS kode_kelas, tb_mapel.mapel, tb_guru.nip, tb_guru.nama AS nama_guru,tb_jadwal.hari, tb_jadwal.jam
            FROM tb_jadwal
            INNER JOIN tb_kodekelas ON tb_jadwal.id_kodekelas = tb_kodekelas.id
            INNER JOIN tb_guru ON tb_jadwal.id_guru = tb_guru.id
            INNER JOIN tb_mapel ON tb_kodekelas.id_mapel = tb_mapel.id
            GROUP BY id
            ORDER BY kode_kelas"
        );

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectJoinJadwalById($db, $id)
    {
        $query = $db->prepare(
            "SELECT tb_jadwal.id_kodekelas AS id, tb_kodekelas.kode AS kode_kelas, tb_mapel.mapel, tb_guru.nip, tb_guru.nama AS nama_guru,tb_jadwal.hari, tb_jadwal.jam
            FROM tb_jadwal
            INNER JOIN tb_kodekelas ON tb_jadwal.id_kodekelas = tb_kodekelas.id
            INNER JOIN tb_guru ON tb_jadwal.id_guru = tb_guru.id
            INNER JOIN tb_mapel ON tb_kodekelas.id_mapel = tb_mapel.id
            WHERE tb_jadwal.id_kodekelas = :id
            ORDER BY 
                CASE
                    WHEN hari = 'Senin' THEN 1
                    WHEN hari = 'Selasa' THEN 2
                    WHEN hari = 'Rabu' THEN 3
                    WHEN hari = 'Kamis' THEN 4
                    WHEN hari = 'Jumat' THEN 5
                END, jam"
        );

        $query->bindParam(":id", $id);

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectJoinJadwalByIdUser($db, $id)
    {
        $query = $db->prepare(
            "SELECT tb_jadwal.id_kodekelas AS id, tb_kodekelas.kode AS kode_kelas, tb_mapel.mapel, tb_guru.nip, tb_guru.nama AS nama_guru,tb_jadwal.hari, tb_jadwal.jam
            FROM tb_jadwal
            INNER JOIN tb_kodekelas ON tb_jadwal.id_kodekelas = tb_kodekelas.id
            INNER JOIN tb_guru ON tb_jadwal.id_guru = tb_guru.id
            INNER JOIN tb_mapel ON tb_kodekelas.id_mapel = tb_mapel.id
            WHERE tb_jadwal.id_guru = :id
            ORDER BY 
                CASE
                    WHEN hari = 'Senin' THEN 1
                    WHEN hari = 'Selasa' THEN 2
                    WHEN hari = 'Rabu' THEN 3
                    WHEN hari = 'Kamis' THEN 4
                    WHEN hari = 'Jumat' THEN 5
                END, jam"
        );

        $query->bindParam(":id", $id);

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function selectJoinKelasById($db, $id)
    {
        $query = $db->prepare(
            "SELECT tb_kelas.id_kodekelas AS id_kelas, tb_kelas.id_siswa AS id_siswa, tb_siswa.nis, tb_siswa.nama AS nama_siswa
            FROM tb_kelas
            INNER JOIN tb_kodekelas ON tb_kelas.id_kodekelas = tb_kodekelas.id
            INNER JOIN tb_siswa ON tb_kelas.id_siswa = tb_siswa.id
            WHERE tb_kelas.id_kodekelas = :id
            ORDER BY id_siswa"
        );

        $query->bindParam(":id", $id);

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function createUser($db, $ni, $nama, $password, $role)
    {
        if ($role == "Guru") {
            $query = $db->prepare(
                "INSERT INTO tb_guru(nip, nama, password, role) VALUE(:ni, :nama, :password, :role)"
            );

        } else if ($role == "Siswa") {
            $query = $db->prepare(
                "INSERT INTO tb_siswa(nis, nama, password, role) VALUE(:ni, :nama, :password, :role)"
            );

        } else if ($role == "Staff") {
            $query = $db->prepare(
                "INSERT INTO tb_staff(nip, nama, password, role) VALUE(:ni, :nama, :password, :role)"
            );

        } else {
            $query = "";
        }

        $query->bindParam(":ni", $ni);
        $query->bindParam(":nama", $nama);
        $query->bindParam(":password", $password);
        $query->bindParam(":role", $role);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function createMapel($db, $kode, $mapel)
    {
        $query = $db->prepare(
            "INSERT INTO tb_mapel(kode, mapel) VALUE(:kode, :mapel)"
        );

        $query->bindParam(":kode", $kode);
        $query->bindParam(":mapel", $mapel);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function createKodeKelas($db, $kode, $mapel)
    {
        $query = $db->prepare(
            "INSERT INTO tb_kodekelas(kode, id_mapel) VALUE(:kode, :mapel)"
        );
        
        $query->bindParam(":kode", $kode);
        $query->bindParam(":mapel", $mapel);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function createJadwal($db, $kodekelas, $guru, $hari, $jam)
    {
        $query = $db->prepare(
            "INSERT INTO tb_jadwal(id_kodekelas, id_guru, hari, jam) VALUE(:kodekelas, :guru, :hari, :jam)"
        );
        
        $query->bindParam(":kodekelas", $kodekelas);
        $query->bindParam(":guru", $guru);
        $query->bindParam(":hari", $hari);
        $query->bindParam(":jam", $jam);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function createKelas($db, $siswa, $kodekelas)
    {
        $query = $db->prepare(
            "INSERT INTO tb_kelas(id_siswa, id_kodekelas) VALUE(:siswa, :kodekelas)"
        );
        
        $query->bindParam(":siswa", $siswa);
        $query->bindParam(":kodekelas", $kodekelas);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function updateDataUser($db, $ni, $nama, $password, $role, $id)
    {
        if ($password == "") {
            if ($role == "Guru") {
                $query = $db->prepare(
                    "UPDATE tb_guru SET nip = :ni, nama = :nama WHERE id = :id"
                );

            } else if ($role == "Siswa") {
                $query = $db->prepare(
                    "UPDATE tb_siswa SET nis = :ni, nama = :nama WHERE id = :id"
                );

            } else if ($role == "Staff") {
                $query = $db->prepare(
                    "UPDATE tb_staff SET nip = :ni, nama = :nama WHERE id = :id"
                );

            } else {
                $query = "";

            }

            $query->bindParam(":ni", $ni);
            $query->bindParam(":nama", $nama);
            $query->bindParam(":id", $id);
        } else {
            if ($role == "Guru") {
                $query = $db->prepare(
                    "UPDATE tb_guru SET nip = :ni, nama = :nama, password = :password WHERE id = :id"
                );

            } else if ($role == "Siswa") {
                $query = $db->prepare(
                    "UPDATE tb_siswa SET nis = :ni, nama = :nama, password = :password WHERE id = :id"
                );

            } else if ($role == "Staff") {
                $query = $db->prepare(
                    "UPDATE tb_staff SET nip = :ni, nama = :nama, password = :password WHERE id = :id"
                );

            } else {
                $query = "";

            }

            $query->bindParam(":ni", $ni);
            $query->bindParam(":nama", $nama);
            $query->bindParam(":password", $password);
            $query->bindParam(":id", $id);
        }


        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function updateDataMapel($db, $kode, $mapel, $id)
    {
        $query = $db->prepare(
            "UPDATE tb_mapel SET kode = :kode, mapel = :mapel WHERE id = :id"
        );

        $query->bindParam(":kode", $kode);
        $query->bindParam(":mapel", $mapel);
        $query->bindParam(":id", $id);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }
    
    public function updateKodeKelas($db, $kode, $mapel, $id)
    {
        $query = $db->prepare(
            "UPDATE tb_kodekelas SET kode = :kode, id_mapel = :mapel WHERE id = :id"
        );

        $query->bindParam(":kode", $kode);
        $query->bindParam(":mapel", $mapel);
        $query->bindParam(":id", $id);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function updateDataKelas($db, $siswa, $id)
    {
        $query = $db->prepare(
            "UPDATE tb_kelas SET id_siswa = :siswa WHERE id = :id"
        );

        $query->bindParam(":siswa", $siswa);
        $query->bindParam(":id", $id);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }
    
    public function updateJadwalGuru($db, $guru, $kelas)
    {
        $query = $db->prepare(
            "UPDATE tb_jadwal SET id_guru = :guru WHERE id_kodekelas = :kelas"
        );

        $query->bindParam(":guru", $guru);
        $query->bindParam(":kelas", $kelas);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }
    
    public function updateJadwalWaktu($db, $hari1, $jam1, $hari2, $jam2, $id)
    {
        $query = $db->prepare(
            "UPDATE tb_jadwal SET hari = :hari2, jam = :jam2 WHERE id_kodekelas = :id AND hari = :hari1 AND jam = :jam1"
        );

        $query->bindParam(":hari1", $hari1);
        $query->bindParam(":jam1", $jam1);
        $query->bindParam(":hari2", $hari2);
        $query->bindParam(":jam2", $jam2);
        $query->bindParam(":id", $id);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function updatePassword($db, $role, $id, $password)
    {
        if ($role == "Guru") {
            $query = $db->prepare(
                "UPDATE tb_guru SET password = :password WHERE id = :id"
            );
        } else  if ($role == "Siswa"){
            $query = $db->prepare(
                "UPDATE tb_siswa SET password = :password WHERE id = :id"
            );
        }
        

        $query->bindParam(":password", $password);
        $query->bindParam(":id", $id);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function deleteData($db, $role, $id)
    {
        if ($role == "Guru") {
            $query = $db->prepare(
                "DELETE FROM tb_guru WHERE id = :id"
            );

        } else if ($role == "Siswa") {
            $query = $db->prepare(
                "DELETE FROM tb_siswa WHERE id = :id"
            );

        } else if ($role == "Staff") {
            $query = $db->prepare(
                "DELETE FROM tb_staff WHERE id = :id"
            );

        } else if ($role == "Mapel") {
            $query = $db->prepare(
                "DELETE FROM tb_mapel WHERE id = :id"
            );

        } else if ($role == "Kelas") {
            $query = $db->prepare(
                "DELETE FROM tb_kelas WHERE id_siswa = :id"
            );

        } else if ($role == "Jadwal") {
            $query = $db->prepare(
                "DELETE FROM tb_jadwal WHERE id_kodekelas = :id"
            );

        } else if ($role == "KodeKelas") {
            $query = $db->prepare(
                "DELETE FROM tb_kodekelas WHERE id = :id"
            );

        } else {
            $query = "";
        }

        $query->bindParam(":id", $id);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

    public function deleteJadwalWaktu($db, $id, $hari, $jam)
    {
        $query = $db->prepare(
            "DELETE FROM tb_jadwal WHERE id_kodekelas = :id AND hari = :hari AND jam = :jam"
        );

        $query->bindParam(":id", $id);
        $query->bindParam(":hari", $hari);
        $query->bindParam(":jam", $jam);

        if ($query->execute()) {
            return true;

        } else {
            return false;

        }
    }

}