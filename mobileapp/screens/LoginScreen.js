// LoginScreen.js
import React, { useState } from 'react';
import { View, ImageBackground, StyleSheet, KeyboardAvoidingView, Platform } from 'react-native';
import { Card, Input, Button as RNEButton } from 'react-native-elements';

const backgroundImage = require('../assets/bg.png'); // Adjust the path based on your file location

const LoginScreen = ({ navigation }) => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');

  const handleLogin = () => {
    // Validate input
    if (!username || !password) {
      // Display an error message or toast
      return;
    }

    // Implement your login logic here
    // For simplicity, let's navigate to the Dashboard screen
    navigation.navigate('Dashboard');
  };

  return (
    <KeyboardAvoidingView
      behavior={Platform.OS === 'ios' ? 'padding' : 'height'}
      style={styles.container}
    >
      <ImageBackground source={backgroundImage} style={styles.backgroundImage}>
        <View style={styles.cardContainer}>
          <Card>
            <Card.Title style={styles.cardTitle}>Login</Card.Title>
            <Card.Divider />
            <Input
              placeholder="Username"
              value={username}
              onChangeText={(text) => setUsername(text)}
              leftIcon={{ type: 'font-awesome', name: 'user' }}
            />
            <Input
              placeholder="Password"
              value={password}
              onChangeText={(text) => setPassword(text)}
              secureTextEntry
              leftIcon={{ type: 'font-awesome', name: 'lock' }}
            />
            <RNEButton title="Login" onPress={handleLogin} />
          </Card>
        </View>
      </ImageBackground>
    </KeyboardAvoidingView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
  backgroundImage: {
    flex: 1,
    justifyContent: 'center',
  },
  cardContainer: {
    backgroundColor: 'rgba(255, 255, 255, 0.8)',
    padding: 16,
    borderRadius: 10,
  },
  cardTitle: {
    fontSize: 24,
    marginBottom: 16,
  },
});

export default LoginScreen;
