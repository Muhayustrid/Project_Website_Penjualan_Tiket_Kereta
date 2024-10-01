import requests
import mysql.connector

# Mengambil data dari URL
url = 'https://portaldata.kemenhub.go.id/api/sigita/stasiun_pt_all?&format=json'
response = requests.get(url)
data = response.json()

# Filter data yang diperlukan
filtered_data = []
for item in data:
    nama_stasiun = item.get('namobj')
    kode_stasiun = item.get('kodkod')
    alamat = item.get('kabkot')
    status = item.get('status_operasi')  # Asumsikan ada kunci 'status' di JSON
    if nama_stasiun and kode_stasiun and alamat and status.lower() == 'aktif':
        filtered_data.append((kode_stasiun, nama_stasiun, alamat))

# Koneksi ke database MySQL
db_connection = mysql.connector.connect(
    host="localhost",
    user="root",         # ganti dengan username MySQL Anda
    password="",         # ganti dengan password MySQL Anda
    database="keretaapi" # ganti dengan nama database Anda
)
cursor = db_connection.cursor()

# Membuat tabel jika belum ada
cursor.execute("""
CREATE TABLE IF NOT EXISTS stasiun (
    id_stasiun VARCHAR(10) PRIMARY KEY,
    nama_stasiun VARCHAR(255),
    alamat_stasiun TEXT
)
""")

# Memasukkan data ke dalam tabel menggunakan ON DUPLICATE KEY UPDATE
insert_query = """
INSERT INTO stasiun (id_stasiun, nama_stasiun, alamat_stasiun) 
VALUES (%s, %s, %s) 
ON DUPLICATE KEY UPDATE 
nama_stasiun=VALUES(nama_stasiun), 
alamat_stasiun=VALUES(alamat_stasiun)
"""
cursor.executemany(insert_query, filtered_data)

# Commit dan tutup koneksi
db_connection.commit()
cursor.close()
db_connection.close()

print("Data berhasil dimasukkan ke database.")
