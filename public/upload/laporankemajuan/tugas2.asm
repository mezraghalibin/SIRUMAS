.data
	array: .space 24
	arraytanda: .space 20
	space: .space 1
	
	tandatambah: .word '+'
	tandakurang: .word '-'
	tandakali: .word '*'
	tandabagi: .word '/'
	tandasamadengan: .word '='
	
.text
main:
	jal read_int	#read int
	addi $t6,$zero, 0 #untuk indeks tanda
	add $t1,$zero,$v0 #taro inputan
	
	add $t2,$zero, 2 #simpen 2
	add $t3,$zero, 1 #simpen 1
	mul $t4, $t2, $t1 #2n
	sub $t5, $t4, $t3 #2n-1
	
	li $s0, '+' # masukin tambah
	li $s1, '-' # masukin kurang
	li $s2, '*' # masukin kali
	li $s3, '/' # masukin bagi, nantinya cek di input user
	li $s4, '=' # masukin bagi
	
	#masukkan ke dalam 2 array (array dan array baca)
	melooping:
		jal read_int
		sw $v0,array($t0) #ambil nilai di v0 (yg abis di read), masukin ke array($t0)=defaul awal array(0)
		addi $t0,$t0,4 #t0 += 4 tambah indeks array
		addi $t7,$t7,1 #i++ update looping
		beq $t5, $t7, keluarnih  #supaya keluar looping jika sudah selesai
		
		jal read_tanda #baca tanda aritmatiknya
		lb $t9,space #ambil tanda aritmatiknya
		

		beq $t9, $s0, tambah  #baca tanda supaya + jd tanda 1
		beq $t9, $s1, kurang #baca tanda supaya - jd tanda 2
		beq $t9, $s2, kali #baca tanda supaya * jd tanda 3
		beq $t9, $s3, bagi #baca tanda supaya / jd tanda 4
		
		stopping:
		
		addi $t6,$t6,4 #t6 += 4,  tambah indeks array
		addi $t7,$t7,1 #i++, update looping
		
		bne $t5, $t7, melooping  #start looping again!:)
		
	keluarnih:
	
	
	
	li $t0,0 # reset indeks array to 0
	li $t6,0 # reset indeks array to 0
	li $t7,0 # reset i to 0
	
	lw $s4, array($t0) #ambil angka pertama
	li $v0, 1	#print int
	add $a0, $zero, $s4
	syscall
	
	addi $t0,$t0,4 #t0 += 4, increment biar pindah ke angka kedua
	addi $t7,$t7,1 #i++ update looping
	
	melooping2:
		lw $s5, arraytanda($t6) #ambil tanda pertama
		addi $t7,$t7,1 #i++ update looping
		
		addi $t6,$t6,4 #t6 += 4, increment
		
		lw $s6, array($t0) #ambil angka kedua
		addi $t7,$t7,1 #i++ update looping
		addi $t0,$t0,4 #t0 += 4, increment biar pindah ke angka kedua
		beq $s5, 1, menambahkan
		beq $s5, 2, mengurangkan
		beq $s5, 3, mengalikan
		beq $s5, 4, membagi
		beq $t5, $t7, keluar  #supaya keluar looping jika sudah selesai
		
		stop:
		
		bne $t5, $t7, melooping2  #start looping again!:)
		
	keluar:
	
	
	
	
	
tambah:
addi $t8,$zero, 1 #tanda + jadi angka 1
sw $t8,arraytanda($t6) #masukin angka 1 ke array
j stopping

kurang:
addi $t8,$zero, 2
sw $t8,arraytanda($t6) #masukin angka 2 ke array
j stopping

kali:
addi $t8,$zero, 3 #tanda + jadi angka 3
sw $t8,arraytanda($t6) #masukin angka 3 ke array
j stopping

bagi:
addi $t8,$zero, 4 #tanda + jadi angka 4
sw $t8,arraytanda($t6) #masukin angka 4 ke array
j stopping
	
menambahkan:
add $s4, $s4, $s6

#print
li $v0, 4
la $a0, tandatambah
syscall

#print angka kedua
li $v0, 1	#print int
add $a0, $zero, $s6
syscall
j stop

mengurangkan:
sub $s4, $s4, $s6

#print
li $v0, 4
la $a0, tandakurang
syscall

#print angka kedua
li $v0, 1	#print int
add $a0, $zero, $s6
syscall

j stop

mengalikan:
mul $s4, $s4, $s6

#print
li $v0, 4
la $a0, tandakali
syscall

#print angka kedua
li $v0, 1	#print int
add $a0, $zero, $s6
syscall
j stop

membagi:
div $s4, $s6	#membagi a dengan b
mflo $s4		#mengambil hasil pembagian, dimasukkan pada s4

#print
li $v0, 4
la $a0, tandabagi
syscall

#print angka kedua
li $v0, 1	#print int
add $a0, $zero, $s6
syscall
j stop
	
read_int:
	li $v0, 5
	syscall
	jr $ra
	
read_tanda:
	la $a0, space
	li $v0, 8
	syscall
	jr $ra

exit:
	li $v0, 10
	syscall