import pandas as pd

kategori_dict = {
    'IT - Elektronik': 1,
    'Furniture': 2,
    'Perlengkapan Kantor': 3,
    'Peralatan Kantor': 4,
    'Infrastuktur - Elektronik' and 'Infrastruktur - Elektronik' : 5,
    'Alat kantor - Elektronik': 6,
    'Alat Teknisi' and 'Alat  Teknisi': 7,
    'Alat Vakum+Sealer+Plastik Vakum' and 'Alat Vakum+Sealer+Plastik Vakum' : 8
}
jabatan_dict = {
    'Staff': 1,
    'Direktur Utama': 2,
    'Ass. Dir. Utama': 3,
    'Direktur Operasional': 4,
    'Ass. Dir. Operasional': 5,
    'Direktur Finance': 6,
    'Ass. Dir. Finance': 7,
    'Head Unit': 8,
    'Senior Manager': 9,
    'Manager': 10,
    'Supervisor': 11,
    'PIC': 12,
    'Security': 13,
    'Teknisi': 14
}
divisi_dict = {
    'Humas & Service': 1,
    'Operasional': 2,
    'Manufaktur': 3,
    'Ekspedisi': 4,
    'Produksi': 5,
    'HRD': 6,
    'Planner': 7,
    'Marketing': 8,
    'Business Development': 9,
    'Partnership & Support': 10,
    'Finance': 11,
    'Logistik': 12,
    'stokis': 13,
    'Direktur': 14,
    'Head Unit': 15,
    'Asset': 16,
    'Admin': 17,
    'Kemitraan': 18
}
df = pd.read_csv('hai.csv')
#haii.csv adalah data asset yang masih berantakan
df['Kondisi'] = df['Kondisi'].replace('Perbaikan', 'Maintenance')
df['Kategori'] = df['Kategori'].replace(kategori_dict)
df['Jabatan'] = df['Jabatan'].replace(jabatan_dict)
df['Divisi'] = df['Divisi'].replace(divisi_dict)
df['Kategori'] = df['Kategori'].fillna(0)
df['Jabatan'] = df['Jabatan'].fillna(0)
df['Divisi'] = df['Divisi'].fillna(0)
df['Kategori'] = df['Kategori'].astype(int)
df['Jabatan'] = df['Jabatan'].astype(int)
df['Divisi'] = df['Divisi'].astype(int)
df['Kategori'] = df['Kategori'].replace(0, '')
df['Jabatan'] = df['Jabatan'].replace(0, '')
df['Divisi'] = df['Divisi'].replace(0, '')
df.to_csv('databaru4.csv', index=False)
print("Nilai 'Perbaikan' di kolom 'Kondisi' telah diubah menjadi 'Maintenance'")
print("Kolom Kategori, Jabatan, dan Divisi berhasil diubah menjadi ID.")
