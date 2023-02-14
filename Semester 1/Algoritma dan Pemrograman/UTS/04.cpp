#include <iostream>

using namespace std;

int main() {
	int rows;
	cout << "Masukkan jumlah deret : ";
	cin >> rows;
	cout<<"\n";
	cout<<" NIM : 210401070069"<<endl;
	cout<<" Nama : Qorri Dwi Istajib"<<endl;
	cout<<" Kelas : IT101"<<endl;
	cout<<"\n";
	cout<<"Jumlah Deret : "<<rows<<"\n"<<endl;
	
	cout<<"DERET KE 1"<<"\n"<<endl;
	for(int i = 1; i <= rows-1; ++i){
		for(int j = 1; j <= i; ++j){
			cout << j << " ";
		}
		cout << endl;
	}
	for(int a = rows; a >= 1; --a){
		for(int b = 1; b <= a; ++b){
			cout << b << " ";
		}
		cout << endl;
	}
	
	cout<<"\n";
	cout<<"DERET KE 2"<<"\n"<<endl;
	
	for(int e = rows; e >= 1; --e){
		for(int f = 1; f <= e; f++){
			cout <<f<<" ";
		}
		cout << endl;
	}
	
	for(int g = 2; g <= rows; ++g){
		for(int h = 1; h <= g; h++){
			cout <<h<<" ";
		}
		cout << endl;
	}
	
	cout<<endl;
	return 0;
}