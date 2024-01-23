// PaymentScreen.js
import React, { useState, useEffect } from 'react';
import { View, Text, ScrollView, StyleSheet, Modal, TouchableOpacity, Image, ImageBackground } from 'react-native';
import { Table, Row } from 'react-native-table-component';
import { Card, Icon } from 'react-native-elements';

const PaymentScreen = ({ navigation }) => {
  const [payments, setPayments] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [selectedPayment, setSelectedPayment] = useState(null);
  const [isModalVisible, setModalVisible] = useState(false);
  const profile = require("../assets/user.jpg");
  const backgroundImage = require("../assets/bg2.jpg");


  useEffect(() => {
    // Fetch payment data when the component mounts
    fetchPaymentData();
  }, []);

  const fetchPaymentData = async () => {
    try {
      const response = await fetch('http://10.30.19.146:3001/api/payments');

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const data = await response.json();

      // Assuming the API response contains an array of payments
      setPayments(data.payments);
      setLoading(false);
    } catch (error) {
      console.error('Error fetching payment data:', error);
      setError('Error fetching payment data. Please try again.');
      setLoading(false);
    }
  };

  const handleView = (payment) => {
    setSelectedPayment(payment);
    setModalVisible(true);
  };

  const renderTableData = () => {
    return payments.map((payment) => (
      <Row
        key={payment.id}
        data={[
          payment.id.toString(),
          payment.orderid,
          payment.amount,
          payment.status,
         
          <TouchableOpacity onPress={() => handleView(payment)}>
            <Icon name="eye" type="font-awesome" color="#517fa4" />
          </TouchableOpacity>,
        ]}
        textStyle={styles.text}
      />
    ));
  };

  return (
    <ImageBackground source={backgroundImage} style={styles.backgroundImage}>
    <ScrollView>
      <View style={styles.container}>
        {loading && <Text>Loading...</Text>}
        {error && <Text style={styles.errorText}>{error}</Text>}

        {!loading && !error && (
          <Card containerStyle={styles.cardContainer}>
            <Table borderStyle={{ borderWidth: 2, borderColor: '#c8e1ff' }}>
              <Row
                data={['ID', 'Order ID', 'Amount', 'Status', 'Actions']}
                style={styles.head}
                textStyle={styles.headText}
              />
              {renderTableData()}
            </Table>
          </Card>
        )}

        <Modal animationType="slide" transparent={true} visible={isModalVisible}>
          <View style={styles.modalContainer}>
            <View style={styles.modalContent}>
              <Text style={styles.modalTitle}>Payment Details</Text>
              <View style={styles.centered}>
       
                  <Image source={profile} style={styles.customerImage} />
               
              </View>
              <View style={styles.detailsContainer}>
              <Text style={styles.detailText}><Icon name="id-card" type="font-awesome" color="#517fa4" /> Name: {selectedPayment?.court_name}</Text>
                <Text style={styles.detailText}><Icon name="id-card" type="font-awesome" color="#517fa4" />  Email: {selectedPayment?.court_email}</Text>
                <Text style={styles.detailText}><Icon name="id-card" type="font-awesome" color="#517fa4" />  Contact: {selectedPayment?.court_contact}</Text>
                <Text style={styles.detailText}><Icon name="list-alt" type="font-awesome" color="#517fa4" /> Order ID: {selectedPayment?.orderid}</Text>
                <Text style={styles.detailText}><Icon name="list-alt" type="font-awesome" color="#517fa4" /> Transaction ID: {selectedPayment?.transactionid}</Text>
                <Text style={styles.detailText}><Icon name="rupee" type="font-awesome" color="#517fa4" /> Amount: {selectedPayment?.amount}</Text>
                <Text style={styles.detailText}><Icon name="info" type="font-awesome" color="#517fa4" /> Status: {selectedPayment?.status}</Text>
                
                {/* Add more details as needed */}
              </View>

              <TouchableOpacity onPress={() => setModalVisible(false)}>
                <Text style={styles.closeButton}>Close</Text>
              </TouchableOpacity>
            </View>
          </View>
        </Modal>
      </View>
    </ScrollView>
    </ImageBackground>
  );
};

const styles = StyleSheet.create({
    backgroundImage: {
        flex: 1,
        resizeMode: 'cover',
      },
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  cardContainer: {
    width: '80%',
  },
  head: { height: 40, backgroundColor: '#f1f8ff' },
  headText: { margin: 6 },
  text: { margin: 6 },
  errorText: {
    color: 'red',
    marginBottom: 10,
  },
  modalContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  modalContent: {
    backgroundColor: 'white',
    padding: 20,
    borderRadius: 10,
    elevation: 5,
  },
  modalTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  closeButton: {
    color: 'blue',
    marginTop: 10,
    textAlign: 'center',
  },
  detailsContainer: {
    marginTop: 10,
  },
  detailText: {
    marginBottom: 5,
  },
  customerImage: {
    width: 100,
    height: 100,
    borderRadius: 50,
    marginBottom: 10,
    marginLeft:80,
  },
});

export default PaymentScreen;