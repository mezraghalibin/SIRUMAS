.data
	array: .space 24
	space: .space 1
	arraysign: .space 20
	

	plusSign: .word '+'
	subsSign: .word '-'
	multiSign: .word 'x'
	divideSign: .word '/'
	equalSign: .word '='
	
.text
main:
	jal read_int			#read integer
	add $t1, $zero, $v0		#simpan input N
	add $t2, $zero, 1		#simpan nilai 1
	add $t3, $zero, 2		#simpan nilai 2
	
	#Menghitung berapa banyak array yang harus disiapkan
	mul $t4, $t1, $t3		#2N
	sub $t5, $t4, $t2		#2N-1, $t5 = N
	
	li $s0, '+' 			# $s0 = '+'
	li $s1, '-' 			# $s1 = '-'
	li $s2, '*' 			# $s2 = '*'
	li $s3, '/' 			# $s3 = '/'
	li $s4, '=' 			# $s4 = '='
	
	addi $t6, $zero, 0		#Untuk menyimpan indeks tanda

operasi:
	jal read_int			#read integer
	sw $v0,array($t0)		#store int read to array[0]
	addi $t0, $t0, 4		#increment array index by 1
	addi $t7, $t7, 1		#increment counter by 1
	beq $t5, $t7, berhenti	#berhenti looping jika sudah selesai membaca array sesuai N
	
	jal read_string			#read string (tanda operasi matematika)
	lb $t8, space			#simpan tanda operasi matematika
	beq $t8, $s0, plus	  	#if tanda = '+' then $t8 = 1
	beq $t8, $s1, subs 		#if tanda = '-' then $t8 = 2
	beq $t8, $s2, multi		#if tanda = '*' then $t8 = 3
	beq $t8, $s3, divide 	#if tanda = '/' then $t8 = 4
	
berhenti:
	li $t0,0 				# reset index array to 0
	li $t6,0 				# reset index arraysign to 0
	li $t7,0 				# reset counter to 0
	
	lw $s5, array($t0) 		#load int read to array[0]
	li $v0, 1				#print int
	add $a0, $zero, $s4
	syscall
	
	addi $t0, $t0, 4		#increment array index by 1
	addi $t7, $t7, 1		#increment counter by 1

operasilagi:
	lw $s6, arraysign($t6)	#load int read to array[0]
	addi $t6, $t6, 4		#increment array index by 1
	addi $t7, $t7, 1		#increment counter by 1		

	
	## THE SUB-ROUTINES
	
	plus:
	addi $t9, $zero, 1 		#$t9 = 1
	sw $t9, arraysign($t6) 	#angka 1 dimasukkan ke array
	j stopping

	subs:
	addi $t9, $zero, 2 		#$t9 = 2
	sw $t9, arraysign($t6) 	#angka 2 dimasukkan ke array
	j stopping
	
	multi:
	addi $t9, $zero, 3 		#$t9 = 3
	sw $t9, arraysign($t6) 	#angka 3 dimasukkan ke array
	j stopping
	
	divide:
	addi $t9, $zero, 4 		#$t9 = 4
	sw $t9, arraysign($t6) 	#angka 4 dimasukkan ke array
	j stopping
	
	read_int:			# sub-routine to read integer
	li $v0, 5
	syscall
	jr $ra
		
	read_string:		# sub-routine to read string
	la $a0, space
	li $v0, 8
	syscall
	jr $ra

	exit:
	li $v0, 10
	syscall
	
	