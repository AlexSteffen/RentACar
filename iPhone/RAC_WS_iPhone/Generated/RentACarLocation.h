/*
	RentACarLocation.h
	The interface definition of properties and methods for the RentACarLocation object.
	Generated by SudzC.com
*/

#import "Soap.h"
	

@interface RentACarLocation : SoapObject
{
	NSString* _city;
	NSString* _email;
	int __id;
	NSString* _phone;
	NSString* _street;
	NSString* _zip;
	
}
		
	@property (retain, nonatomic) NSString* city;
	@property (retain, nonatomic) NSString* email;
	@property int _id;
	@property (retain, nonatomic) NSString* phone;
	@property (retain, nonatomic) NSString* street;
	@property (retain, nonatomic) NSString* zip;

	+ (RentACarLocation*) newWithNode: (CXMLNode*) node;
	- (id) initWithNode: (CXMLNode*) node;
	- (NSMutableString*) serialize;
	- (NSMutableString*) serialize: (NSString*) nodeName;
	- (NSMutableString*) serializeAttributes;
	- (NSMutableString*) serializeElements;

@end
