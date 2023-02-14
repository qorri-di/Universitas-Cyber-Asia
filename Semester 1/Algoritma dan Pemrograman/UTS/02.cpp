#include <iostream>
using namespace std;
int main(){
	int a;
	for(a=1; a<=5; a++){
		if(a==1){
			cout<<"1"<<endl;
		} else if(a==2){
			cout<<"1 3"<<endl;
		} else if(a==3){
			cout<<"1 3 7"<<endl;
		} else if(a==4){
			cout<<"1 3 7 9"<<endl;
		} else if(a==5){
			cout<<"1 3 7 9 11"<<endl;
		}
	}
	return 0;
}