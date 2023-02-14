#include <iostream>
#include <string>

using namespace std;

int main() {
	int64_t nim, n;
	string nm, sts;
	char hrf;
	cout<<"Masukkan Data"<<endl;
	cout<<"NIM : ";cin>>nim;
	cout<<"Nama : ";cin>>nm;
	cout<<"Nilai : ";cin>>n;
	cout<<"\n";
	
	if(n>=80){
		hrf='A';
	}else if(n>=70&&n<80){
		hrf='B';
	}else if(n>=60&&n<70){
		hrf='C';
	}else if(n>=50&&n<60){
		hrf='D';
	}else if(n<50){
		hrf='E';
	}
	
	if(hrf=='A'||hrf=='B'||hrf=='C'){
		sts="Lulus";
	}else if(hrf=='D'){
		sts="Mengulang";
	}else if(hrf=='E'){
		sts="Tidak Lulus";
	}
	cout<<" nim Nama Nilai Grade Status"<<endl;
	cout<<"-------------------------------------------------------"<<endl;
	cout<<nim<<" "<<nm<<" "<<n<<" "<<hrf<<" "<<sts<<endl;
	return 0;
}